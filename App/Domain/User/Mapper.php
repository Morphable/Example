<?php

namespace App\Domain\User;

class Mapper
{
    public function normalize(array $user)
    {
        if ($user['profilePic'] == null) {
            $user['profilePic'] = 'http://via.placeholder.com/128x128';
        }

        if ($user['bio'] == null) {
            $user['bio'] = 'No information given';
        }

        return $user;
    }
}
