<?php

namespace App\Domain\Auth\Action;

use \Firebase\JWT\JWT;
use \App\Infrastructure\Application as A;

class SetLoggedIn
{
    private $authUser;

    private $rememberMe;

    private $response;

    private $secret;

    public $expiry;

    public $token;

    public function __construct(array $authUser, bool $rememberMe = false, $response = null)
    {
        $this->authUser = $authUser;
        $this->rememberMe = $rememberMe;
        $this->response = $response;
    }

    public function getExpiryDate()
    {
        return $this->expiry;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setCookie()
    {
        setcookie('token', $this->token, strtotime($this->expiry), '/');
        return $this;
    }

    public function execute()
    {
        $load = $this->authUser;

        $load['expiry'] = date("Y-m-d H:i:s", strtotime("+1 day"));
        if ($this->rememberMe) {
            $load['expiry'] = date("Y-m-d H:i:s", strtotime("+1 year"));
        }

        $this->expiry = $load['expiry'];

        $this->token = A::getService('encryption')->encrypt($load);
        return $this;
    }
}
