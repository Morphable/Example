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

    public function broadSearch(string $query)
    {
        $query = "%$query%";
        $postsTmp = $this->db->builder('posts')
            ->select('`id`')
            ->where('`content` LIKE ?', [$query])
            ->limit(25)
            ->execute()
            ->fetch();

        $posts = [];
        foreach ($postsTmp as $post) {
            $posts[] = $this->getPostById($post['id']);
        }

        return $posts;
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
