<?php

namespace App\Infrastructure\Controller;

use \App\Infrastructure\Application as A;
use \Respect\Validation\Validator as V;
use \App\Component\Message\Form as FormMessage;
use \App\Domain\User;
use \App\Domain\Auth\Action\SetLoggedIn;

class AuthController
{
    public static function login($req, $res)
    {
        $message = new FormMessage();
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $rememberMe = isset($_POST['remember-me']) && $_POST['remember-me'] == 'on';

        $user = A::getService('userRepository')->getAuthUser($email);

        if (empty($user)) {
            $message->setGeneral(FormMessage::ERROR, 'Failed to login');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        if (!password_verify($password, $user['password'])) {
            $message->setGeneral(FormMessage::ERROR, 'Failed to login');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        (new User())
            ->setId($user['id'])
            ->setLastActive()
            ->update();

        (new SetLoggedIn($user, $rememberMe, $res))->execute()->setCookie();


        header('Location: /dashboard');
        return;
    }

    public static function logout($req, $res)
    {
        setcookie('token', null, 0, '/');
        unset($_SESSION['user']);

        $message = new FormMessage();
        $message->setGeneral(FormMessage::SUCCESS, 'Logged out');
        $message->exec();

        header('Location: /');
        return;
    }

    public static function register($req, $res)
    {
        $message = new FormMessage();
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordRepeat = trim($_POST['password-repeat']);

        $valid = true;

        if (!V::stringType()->length(3, 26)->validate($username)) {
            $valid = false;
            $message->setField('username', 'Length must be between 3 and 26');
        } elseif (A::getService('userRepository')->checkUsernameUsed($username)) {
            $valid = false;
            $message->setField('username', 'Username already in use');
        }

        if (!V::email()->validate($email)) {
            $valid = false;
            $message->setField('email', 'Email must be valid');
        } elseif (A::getService('userRepository')->checkEmailUsed($email)) {
            $valid = false;
            $message->setField('email', 'Email is already in use');
        }

        if (!V::stringType()->length(6)->validate($password)) {
            $valid = false;
            $message->setField('password', 'Password must be longer than 6');
        }

        if (!V::stringType()->equals($password)->validate($passwordRepeat)) {
            $valid = false;
            $message->setField('password-repeat', 'Password must be equal');
        }

        if (!$valid) {
            $message->setGeneral(FormMessage::ERROR, 'Form has errors');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        $insert = (new User())
            ->setEmail($email)
            ->setPassword($password)
            ->setUsername($username)
            ->insert();

        if (!$insert) {
            $message->setGeneral(FormMessage::ERROR, 'Something went wrong with registering');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        (new User())
            ->setId($insert->getLastInsertId())
            ->setLastActive()
            ->update();

        $user = A::getService('userRepository')->getAuthUserById($insert->getLastInsertId());

        (new SetLoggedIn($user, false, $res))->execute()->setCookie();

        header('Location: /dashboard');
        return;
    }

    public static function forgotPassword($req, $res)
    {
        # code...
    }
}
