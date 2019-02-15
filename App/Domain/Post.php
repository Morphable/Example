<?php

namespace App\Domain;

class Post extends \App\Infrastructure\Model
{
    protected $table = 'posts';

    public function beforeInsert()
    {
        $this->set('createdAt', date('Y-m-d H:i:s'));
    }

    public function beforeUpdate()
    {
        return;
    }

    public function setTags(string $tags)
    {
        return $this->set('tags', $tags);
    }

    public function setContent(string $content)
    {
        return $this->set('content', $content);
    }

    public function setUserId(int $userId)
    {
        return $this->set('userId', $userId);
    }
}
