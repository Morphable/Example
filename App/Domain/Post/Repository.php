<?php

namespace App\Domain\Post;

class Repository extends \App\Infrastructure\Repository
{
    public function getPostsByUserId(int $userId, int $limit = 25, int $page = 1)
    {
        return $this->db->builder('posts')
            ->where('`userId` = ?', $userId)
            ->orderBy('`dateAdded` DESC')
            ->limit($limit)
            ->offset($limit * $page)
            ->execute()
            ->fetch();
    }
}
