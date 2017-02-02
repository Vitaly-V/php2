<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$route = \App\Router::getRoute($_SERVER['REQUEST_URI']);

if ($route) {
    $controller = new $route['controller'];
    $controller->action($route['action']);
} else {
    echo('Route was not found');
    die;
}