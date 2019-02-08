<?php

use \App\Infrastructure\Controller\StaticPageController;
use \App\Infrastructure\Controller\ResourceController;
use \App\Infrastructure\Controller\AuthController;

// predefine routes with static method as callback
return [
    'resources' => [
        'method' => 'get',
        'route' => '/resources/:type',
        'callback' => [ResourceController::class, 'serve']
    ],
    'index' => [
        'method' => 'GET',
        'route' => '/',
        'callback' => [StaticPageController::class, 'serveHome']
    ],
    'home' => [
        'method' => 'GET',
        'route' => '/home',
        'callback' => [StaticPageController::class, 'serveHome']
    ],
    'authPage' => [
        'method' => 'GET',
        'route' => '/auth',
        'callback' => [StaticPageController::class, 'serveAuth']
    ],
    'login' => [
        'method' => 'POST',
        'route' => '/auth/login',
        'callback' => [AuthController::class, 'login']
    ],
    'logout' => [
        'method' => 'POST',
        'route' => '/auth/logout',
        'callback' => [AuthController::class, 'logout']
    ],
    'register' => [
        'method' => 'POST',
        'route' => '/auth/register',
        'callback' => [AuthController::class, 'register']
    ],
    'forgotPassword' => [
        'method' => 'POST',
        'route' => '/auth/login',
        'callback' => [AuthController::class, 'forgotPassword']
    ],

];
