<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\Application;

class AuthController
{
    public static function login($req, $res)
    {
        print_r($_POST);
        die;
    }

    public static function logout($req, $res)
    {
        # code...
    }

    public static function register($req, $res)
    {
        # code...
    }

    public static function forgotPassword($req, $res)
    {
        # code...
    }
}
