<?php

namespace App\Domain\User;

class Mapper
{
    public function normalize(array $user)
    {
        if (!isset($user['profilePic']) || $user['profilePic'] == '') {
            $user['profilePic'] = 'http://via.placeholder.com/128x128';
        }

        if (!isset($user['bio']) || $user['bio'] == '') {
            $user['bio'] = 'No information given';
        }

        return $user;
    }
}
