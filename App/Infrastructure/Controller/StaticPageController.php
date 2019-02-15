<?php

namespace App\Infrastructure\Controller;

use \App\Infrastructure\Application;
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
            Application::getService("view")->serve("pages/home.php", [
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
            Application::getService("view")->serve("pages/auth.php", [
                'page' => 'auth'
            ])
        );
    }

    public static function serveDashboard($req, $res)
    {
        return $res->sendResponse(
            Application::getService("view")->serve("pages/dashboard.php", [
                'page' => 'dashboard'
            ])
        );
    }
}
