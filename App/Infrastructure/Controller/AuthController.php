<?php

namespace App\Infrastructure\Controller;

use \App\Infrastructure\Application;
use \Respect\Validation\Validator as V;
use \App\Component\Message\Form as FormMessage;
use \App\Domain\User;

class AuthController
{
    public static function login($req, $res)
    {
        $message = new FormMessage();
        $message->setGeneral(FormMessage::ERROR, 'not implemented');
        $message->exec();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return;
    }

    public static function logout($req, $res)
    {
        $message = new FormMessage();
        $message->setGeneral(FormMessage::ERROR, 'not implemented');
        $message->exec();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return;
    }

    public static function register($req, $res)
    {
        $message = new FormMessage();
        $data = $_POST;

        $valid = true;

        if (!V::stringType()->email()->validate($data['email'])) {
            $valid = false;
            $message->setField('email', 'Email must be valid');
        }

        if (!V::stringType()->length(6)->validate($data['password'])) {
            $valid = false;
            $message->setField('password', 'Password must be longer than 6');
        }

        if (!V::stringType()->equals($data['password'])->validate($data['password-repeat'])) {
            $valid = false;
            $message->setField('password-repeat', 'Password must be equal');
        }

        if (!$valid) {
            $message->setGeneral(FormMessage::ERROR, 'Form has errors');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        $user = (new User())
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->insert();

        header('Location: /');
    }

    public static function forgotPassword($req, $res)
    {
        # code...
    }
}
