<?php

namespace App\Domain\Post;

use \App\Infrastructure\Application as A;

class Repository extends \App\Infrastructure\Repository
{
    public function getPostById(int $postId)
    {
        return $this->db->builder('posts')
            ->select('users.slug, posts.userId, users.username, users.profilePic, posts.content, posts.tags, posts.img, posts.createdAt')
            ->join('users on users.id = posts.userId')
            ->where('posts.id = ?', $postId)
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

    public function getLatestPostsFromFollowing(int $userId, int $limit = 25, int $page = 0)
    {
        $users = A::getService('userRepository')->getFollowing($userId);

        $in = "";
        foreach ($users as $user) {
            $in .= "{$user['subjectId']},";
        }
        $in = trim($in, ',');

        $postIds = $this->db->builder('posts')
            ->select('`id`')
            ->where("`userId` in({$in})")
            ->orderBy('`createdAt` DESC')
            ->limit($limit)
            ->offset($limit * $page)
            ->execute()
            ->fetch();

        $posts = [];
        foreach ($postIds as $postId) {
            $post = $this->getPostById($postId['id']);
            $post = A::getService('userMapper')->normalize($post);
            $post = A::getService('postMapper')->normalize($post);

            $posts[] = $post;
        }

        return $posts;
    }
}
