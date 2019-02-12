<?php

namespace App\Domain;

class User extends \App\Infrastructure\Model
{
    public function prepareInsert()
    {
        $this->set('createdAt', date('Y-m-d H:i:s'));
        $this->set('isActive', '0');
        $this->set();
    }

    public function prepareUpdate()
    {
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
