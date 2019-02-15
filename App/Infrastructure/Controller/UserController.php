<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\Application as A;
use \App\Component\Message\Form as FormMessage;
use \App\Domain\Auth\Authorized;
use \App\Domain\Follower;

class UserController
{
    public static function follow($req, $res)
    {
        if (!Authorized::isLoggedIn()) {
            header('Location: /');
            return;
        }

        $message = new FormMessage();

        $subjectId = $req->getParam('userId');
        $userId = $_POST['user-id'];

        if ($userId != $_SESSION['user']['id']) {
            $message->setGeneral(FormMessage::ERROR, 'User is not you');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        if ($subjectId == $userId) {
            $message->setGeneral(FormMessage::ERROR, 'Cannot follow yourself');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        $follower = new Follower();

        if (A::getService('userRepository')->checkUserIsFollowing($userId, $subjectId)) {
            if (!$follower->unfollow($userId, $subjectId)) {
                $message->setGeneral(FormMessage::ERROR, 'Failed to unfollow user');
                $message->exec();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                return;
            }

            $message->setGeneral(FormMessage::SUCCESS, 'Unfollowed user');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        if (!$follower->follow($userId, $subjectId)) {
            $message->setGeneral(FormMessage::ERROR, 'Failed to follow user');
            $message->exec();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        $message->setGeneral(FormMessage::SUCCESS, 'Following user');
        $message->exec();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return;

    }
}
