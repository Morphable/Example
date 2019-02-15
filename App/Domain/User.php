<?php

namespace App\Domain;

class User extends \App\Infrastructure\Model
{
    protected $table = 'users';

    public function prepareInsert()
    {
        $this->set('createdAt', date('Y-m-d H:i:s'));
        $this->set('isActive', '0');
    }

    public function prepareUpdate()
    {
    }

    public function setId($id)
    {
        $this->set('id', $id);
        return $this;
    }

    public function setLastActive()
    {
        $this->set('lastActive', date('Y-m-d H:i:s'));
        return $this;
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
