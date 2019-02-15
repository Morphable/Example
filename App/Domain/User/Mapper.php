<?php

namespace App\Domain\User;

class Mapper
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
