<?php

namespace App\Infrastructure;

use \Morphable\SimpleDatabase;

class Repository
{
    protected $db;

    public function __construct(SimpleDatabase $db)
    {
        $this->db = $db;
    }
}
