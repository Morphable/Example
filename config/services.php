<?php

use \App\Infrastructure\Application;
use \Morphable\SimpleCache;
use \Morphable\SimpleView;
use \Morphable\SimpleDebugger;
use \Morphable\SimpleDatabase;
use \App\Domain\User\Repository as UserRepository;
use \App\Domain\Post\Repository as PostRepository;
use \App\Domain\Post\Mapper as PostMapper;
use \App\Domain\User\Mapper as UserMapper;
use \App\Component\Encryption;

// define services, name => instance
$services =  [
    'cache' => new SimpleCache(Application::getPath('cache')),
    'view' => new SimpleView(Application::getPath('views')),
    'debug' => new SimpleDebugger(),
    'encryption' => new Encryption(getenv('JWT_SECRET')),
    'database' => new SimpleDatabase(
        "sqlite:" . str_replace(':data', Application::getPath('data'), getenv('DB_DNS')),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        null,
        function ($e) {
            die($e->getMessage());
        }
    )
];

$services['userRepository'] = new UserRepository($services['database']);
$services['postRepository'] = new PostRepository($services['database']);
$services['postMapper'] = new PostMapper();
$services['userMapper'] = new UserMapper();

return $services;
