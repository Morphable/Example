<?php

namespace App\Domain;

use \App\Infrastructure\Application as A;

class Follower extends \App\Infrastructure\Model
{
    protected $table = 'followers';

    public function beforeInsert()
    {
    }

    public function beforeUpdate()
    {
    }

    public function follow(int $userId, int $subjectId)
    {
        if (A::getService('userRepository')->checkUserIsFollowing($userId, $subjectId)) {
            return false;
        }

        $this->set('userId', $userId);
        $this->set('subjectId', $subjectId);
        // $this->set('createdAt', date('Y-m-d H:i:s'));
        return $this->insert() ? true : false;
    }

    public function unFollow(int $userId, int $subjectId)
    {
        $followId = A::getService('userRepository')->getFollowId($userId, $subjectId);

        if ($followId < 1) {
            return false;
        }

        $this->set('id', $followId);
        return $this->delete() ? true : false;
    }
}
