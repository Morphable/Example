<?php

namespace App\Domain\User;

use \Morphable\SimpleDatabase;
use \App\Infrastructure\Application as A;

class Repository extends \App\Infrastructure\Repository
{
    private function normalize(array $user)
    {
        return A::getService('userMapper')->normalize($user);
    }

    public function checkEmailUsed(string $email)
    {
        return $this->db->builder('users')
            ->select('COUNT(1) as `total`')
            ->where('`email` = ?', $email)
            ->execute()
            ->fetchOne()['total'] > 0;
    }

    public function checkUsernameUsed(string $username)
    {
        return $this->db->builder('users')
            ->select('COUNT(1) as `total`')
            ->where('`username` = ?', $username)
            ->execute()
            ->fetchOne()['total'] > 0;
    }

    public function checkSlugUsed(string $slug)
    {
        return $this->db->builder('users')
            ->select('COUNT(1) as `total`')
            ->where('`slug` = ?', $slug)
            ->execute()
            ->fetchOne()['total'] > 0;
    }

    public function checkUserIsFollowing(int $userId, int $subjectId)
    {
        return $this->db->builder('followers')
            ->select('COUNT(1) as `total`')
            ->where('`userId` = ? AND `subjectId` = ?', [$userId, $subjectId])
            ->execute()
            ->fetchOne()['total'] > 0;
    }

    public function getFollowId(int $userId, int $subjectId)
    {
        return $this->db->builder('followers')
            ->select('`id`')
            ->where('`userId` = ? AND `subjectId` = ?', [$userId, $subjectId])
            ->execute()
            ->fetchOne()['id'];
    }

    public function getUserIdBySlug(int $userId)
    {
        return $this->db->builder('users')
            ->select('`id`')
            ->where('id = ?', $userId)
            ->execute()
            ->fetchOne()['id'] ?? null;
    }

    public function getAuthUserById(int $id)
    {
        return $this->normalize($this->db->builder('users')
            ->select('`id`, `email`, `password`, `slug`, `isActive`')
            ->where('`id` = ?', $id)
            ->execute()
            ->fetchOne());
    }

    public function broadSearch(string $query)
    {
        $query = "%$query%";

        $usersTmp = $this->db->builder('users')
            ->select(' `id`, `slug` ')
            ->where('`username` LIKE ? OR bio LIKE ?', [$query, $query])
            ->limit(25)
            ->execute()
            ->fetch();

        $users = [];
        foreach ($usersTmp as $user) {
            $users[] = $this->getPublicUser($user['slug']);
        }

        return $users;
    }

    public function getAuthUser(string $email)
    {
        return $this->normalize($this->db->builder('users')
            ->select('`id`, `email`, `password`, `slug`, `isActive`')
            ->where('`email` = ?', $email)
            ->execute()
            ->fetchOne());
    }

    public function getPublicUser(string $slug)
    {
        return $this->normalize($this->db->builder('users')
            ->select('`id`, `isActive`, `username`, `bio`, `slug`, `profilePic`, `createdAt`, `email`')
            ->where('`slug` = ?', $slug)
            ->execute()
            ->fetchOne());
    }
}
