<?php

namespace App\Domain\Post;

class Repository extends \App\Infrastructure\Repository
{
    public function getPostById(int $postId)
    {
        return $this->db->builder('posts')
            ->select('users.slug, users.username, users.profilePic, post.content, posts.img, posts.createdAt')
            ->where('`id` = ?', $postId)
            ->execute()
            ->fetchOne();
    }

    public function getPostsByUserId(int $userId, int $limit = 25, int $page = 0)
    {
        return $this->db->builder('posts')
            ->select('`content`, `img`, `createdAt`, `tags`')
            ->where('`userId` = ?', $userId)
            ->orderBy('`createdAt` DESC')
            ->limit($limit)
            ->offset($limit * $page)
            ->execute()
            ->fetch();
    }
}
