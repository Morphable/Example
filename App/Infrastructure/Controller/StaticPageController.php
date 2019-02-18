<?php

namespace App\Infrastructure\Controller;

use \App\Infrastructure\Application as A;
use \App\Domain\Auth\Authorized;

class StaticPageController
{
    public static function serveHome($req, $res)
    {
        if (Authorized::isLoggedIn()) {
            header('Location: /dashboard');
            die;
        }

        return $res->sendResponse(
            A::getService("view")->serve("pages/home.php", [
                'page' => 'home'
            ])
        );
    }

    public static function serveAuth($req, $res)
    {
        if (Authorized::isLoggedIn()) {
            header('Location: /dashboard');
            die;
        }

        return $res->sendResponse(
            A::getService("view")->serve("pages/auth.php", [
                'page' => 'auth'
            ])
        );
    }

    public static function serveDashboard($req, $res)
    {
        if (!Authorized::isLoggedIn()) {
            header('Location: /auth');
            die;
        }

        return $res->sendResponse(
            A::getService("view")->serve("pages/dashboard.php", [
                'page' => 'dashboard'
            ])
        );
    }

    public static function serveProfile($req, $res)
    {
        $slug = $req->getParam('slug');
        if (strtolower($slug) == 'me' && Authorized::isLoggedIn()) {
            $slug = $_SESSION['user']['slug'];
        }

        $user = A::getService('userRepository')->getPublicUser($slug);

        if (empty($user)) {
            header('Location: /dashboard');
            return;
        }

        $posts = A::getService('postRepository')->getPostsByUserId($user['id']);

        foreach ($posts as $key => $post) {
            $posts[$key] = A::getService('postMapper')->addUserToPost($post, $user);
        }

        return $res->sendResponse(
            A::getService('view')->serve('pages/profile.php', [
                'page' => 'profile',
                'user' => $user,
                'posts' => $posts
            ])
        );
    }

    public static function serveSearch($req, $res)
    {
        return $res->sendResponse(
            A::getService('view')->serve('pages/search.php', [
                'page' => 'search'
            ])
        );
    }
}
