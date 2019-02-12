<?php

namespace App\Component;

class Message
{
    protected $name = null;

    protected $params = [];

    public function set(string $name, $data)
    {
        $this->params[$name] = $data;
        return $this;
    }

    public function exec()
    {
        $_SESSION['message'][$this->name] = $this->params;
        return $this;
    }
}
