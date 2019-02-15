<?php

use \App\Infrastructure\Controller\StaticPageController;
use \App\Infrastructure\Controller\ResourceController;
use \App\Infrastructure\Controller\AuthController;
use \App\Infrastructure\Controller\PostController;

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
    'dashboard' => [
        'method' =>'GET',
        'route' => '/dashboard',
        'callback' => [StaticPageController::class, 'serveDashboard']
    ],
    'profile' => [
        'method' => 'GET',
        'route' => '/profile/:userId',
        'callback' => [StaticPageController::class, 'serveProfile']
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
        'method' => 'GET',
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
    'createPost' => [
        'method' => 'POST',
        'route' => 'post/create',
        'callback' => [PostController::class, 'create']
    ],
    'updatePost' => [
        'method' => 'PUT',
        'route' => 'post/update/:postId',
        'callback' => [PostController::class, 'update']
    ],
    'deletePost' => [
        'method' => 'POST',
        'route' => 'post/delete/:postId',
        'callback' => [PostController::class, 'delete']
    ]
];
