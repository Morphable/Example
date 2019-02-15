<?php

namespace App\Domain\Post;

class Mapper
{
    public function normalize(array $post)
    {
        if (isset($post['tags'])) {
            $post['tags'] = explode(',', $post['tags']);
        } else {
            $post['tags'] = [];
        }

        return $post;
    }

    public function addUserToPost(array $post, array $user)
    {
        $post = $this->normalize($post);
        $post['userId'] = $user['id'];
        $post['username'] = $user['username'];
        $post['slug'] = $user['slug'];
        $post['profilePic'] = $user['profilePic'];
        return $post;
    }
}
