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

    public function setContent(string $content)
    {
        $this->set('content', $content);
        return $this;
    }

    public function setUserId(int $userId)
    {
        $this->set('userId', $userId);
        return $this;
    }
}
