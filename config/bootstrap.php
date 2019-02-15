<?php

use \App\Infrastructure\Application;
use \Morphable\SimpleRouting;
use \Morphable\SimpleRouting\Builder;
use \Symfony\Component\Dotenv\Dotenv;
use \App\Domain\Auth\Authorized;

error_reporting(E_ALL);

session_start();

// require vendor
require __DIR__ . '/../vendor/autoload.php';

// intialize application
Application::initialize(__DIR__ . '/..');

(new Dotenv())->load(Application::getPath('root') . '/.env');

// get predefined services and add them to application
$services = include Application::getPath('config') . '/services.php';

foreach ($services as $name => $service) {
    Application::addService($name, $service);
}

// check if executed as console
if ( php_sapi_name() != 'cli' ) {
    // get predefined routes and add them to the router
    $routes = include Application::getPath('config') . '/routes.php';

    foreach($routes as $name => $route) {
        SimpleRouting::add($name, Builder::fromArray($route));
    }

    // save post fields
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            if (isset($_SESSION['post'][$key])) {
                continue;
            }

            $_SESSION['post'][$key] = $value;
        }
    }

    // set loggedIn user
    unset($_SESSION['user']);
    if (Authorized::isLoggedIn()) {
        $_SESSION['user'] = Authorized::getLoggedInUser();
    }

    // execute router and catch errors
    try {
        SimpleRouting::execute();
    } catch (\Morphable\SimpleRouting\Exception\RouteNotFound  $e) {
        echo Application::getService('view')->serve('errors/404.php');
    }

    // unset messages and post fields
    unset($_SESSION['post']);
    unset($_SESSION['message']);
}


