<?php

namespace App\Infrastructure\Controller;

use \App\Infrastructure\Application as A;
use \Respect\Validation\Validator as V;
use \App\Component\Message\Form as FormMessage;
use \App\Domain\Post;

class PostController
{
    public static function create($req, $res)
    {
        $message = new FormMessage();
        $content = trim($_POST['content']);
        $userId = A::getService('encryption')->decrypt($_POST['user-id']);

        if (!$userId) {
            $message->setGeneral(FormMessage::ERROR, 'Corrupt account');
            $message->exec();
            header('Location: /auth/logout');
            return;
        }

        $valid = true;
        if (!V::stringType()->length(1)->validate($content)) {
            $message->setField('content', 'post cannot be empty LOL');
            $valid = false;
        }

        if (!$valid) {
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        (new Post())
            ->setUserId($userId)
            ->setContent($content)
            ->insert();

        header('Location: /dashboard');
        return;
    }

    public static function update($req, $res)
    {
        # code...
    }

    public static function delete($req, $res)
    {
        # code...
    }
}
