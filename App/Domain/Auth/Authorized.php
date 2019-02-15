<?php

namespace App\Domain\Auth;

use \App\Infrastructure\Application as A;

class Authorized
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_GUEST = 'guest';

    public static function isLoggedIn()
    {
        return isset($_COOKIE['token']) && A::getService('encryption')->decrypt($_COOKIE['token']);
    }

    public static function hasRole(string $role)
    {
        return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == $role;
    }

    public static function getLoggedInUser()
    {
        return (array) A::getService('encryption')->decrypt($_COOKIE['token']);
    }
}
