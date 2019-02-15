<?php

namespace App\Domain\Auth;

use \Firebase\JWT\JWT;

class Authorized
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_GUEST = 'guest';

    public static function isLoggedIn()
    {
        return isset($_COOKIE['token']) && JWT::decode($_COOKIE['token'], getenv('JWT_SECRET'), ['HS256']);
    }

    public static function hasRole(string $role)
    {
        return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == $role;
    }

    public static function getLoggedInUser()
    {
        return (array) JWT::decode($_COOKIE['token'], getenv('JWT_SECRET'), ['HS256']);
    }
}
