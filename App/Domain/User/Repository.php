<?php

namespace App\Domain\User;

use \Morphable\SimpleDatabase;

class Repository
{
    public function __construct(SimpleDatabase $db)
    {
        $this->db = $db;
    }

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
}
