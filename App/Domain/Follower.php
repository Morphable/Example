<?php

namespace App\Domain\User;

class Follower extends \App\Infrastructure\Model
{
    protected $table = 'followers';

    public function beforeInsert()
    {
    }

    public function beforeUpdate()
    {
    }
}
