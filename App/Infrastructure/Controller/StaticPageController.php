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
        $userId = A::getService('encryption')->decrypt($req->getParam('userId'));

        if (!$userId) {
            header('Location: /dashboard');
            return;
        }

        A::getService('userRepository')->getPublicUser($userId);

        return $res->sendResponse(
            A::getService('view')->serve('pages/profile.php', [
                'page' => 'profile'
            ])
        );
    }
}
