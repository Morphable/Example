<?php

namespace App\Domain;

use \App\Infrastructure\Application as A;

class User extends \App\Infrastructure\Model
{
    protected $table = 'users';

    public function beforeInsert()
    {
        $this->set('slug', $this->getUniqueSlug());
        $this->set('createdAt', date('Y-m-d H:i:s'));
        $this->set('isActive', '0');
    }

    public function getUniqueSlug()
    {
        $slug = bin2hex(random_bytes(8));

        if (A::getService('userRepository')->checkSlugUsed($slug)) {
            return $this->getUniqueSlug();
        }

        return $slug;
    }

    public function beforeUpdate()
    {
    }

    public function getResetToken()
    {
        $token = bin2hex(random_bytes(16));

        if (A::getService('userRepository')->checkResetTokenUsed($token)) {
            return $this->getResetToken();
        }

        return $token;
    }

    public function setId($id)
    {
        return $this->set('id', $id);
    }

    public function setLastActive()
    {
        return $this->set('lastActive', date('Y-m-d H:i:s'));
    }

    public function setUsername(string $username)
    {
        return $this->set('username', $username);
    }

    public function setSlug(string $slug)
    {
        return $this->set('slug', $slug);
    }

    public function setResetToken(string $token)
    {
        return $this->set('resetToken', $token);
    }

    public function setBio(string $bio)
    {
        return $this->set('bio', $bio);
    }

    public function setEmail(string $email)
    {
        return $this->set('email', $email);
    }

    public function setPassword($password)
    {
        return $this->set('password', \password_hash($password, PASSWORD_DEFAULT));
    }
}
