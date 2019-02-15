<?php

namespace App\Domain\User;

use \Morphable\SimpleDatabase;

class Repository extends \App\Infrastructure\Repository
{
    public function checkEmailUsed($email)
    {
        return $this->db->builder('users')
            ->select('COUNT(1) as `total`')
            ->where('`email` = ?', $email)
            ->execute()
            ->fetchOne()['total'] > 0;
    }

    public function getAuthUser(string $email)
    {
        return $this->db->builder('users')
            ->select('`id`, `email`, `password`, `isActive`')
            ->where('`email` = ?', $email)
            ->execute()
            ->fetchOne();
    }

    public function getPublicUser(int $id)
    {
        return $this->db->builder('users')
            ->select('`id`, `isActive`, `email`')
            ->where('`id` = ?', $email)
            ->execute()
            ->fetchOne();
    }
}
