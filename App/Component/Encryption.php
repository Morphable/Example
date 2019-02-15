<?php

namespace App\Component;

use \Firebase\JWT\JWT;

class Encryption
{
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function encrypt($data)
    {
        return JWT::encode($data, $this->secret);
    }

    public function decrypt($token)
    {
        return JWT::decode($token, $this->secret, ['HS256']);
    }
}
