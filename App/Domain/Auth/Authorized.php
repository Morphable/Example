<?php

namespace App\Domain\Auth;

class Authorized
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_GUEST = 'guest';

    public static function isLoggedIn()
    {
        return isset($_SESSION['user']['isLoggedIn']) && $_SESSION['user']['isLoggedIn'];
    }

    public static function hasRole(string $role)
    {
        return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == $role;
    }
}
