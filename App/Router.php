<?php

namespace App;

class Router
{

    public static function run()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $urlParts = explode('/', $url['path']);
        $controllerName = !empty($urlParts[1]) ? $urlParts[1] : 'Index';
        $actionName = !empty($urlParts[2]) ? $urlParts[2] : 'Index';
        $controllerClass = '\\App\\Controllers\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            die('Controller was not found');
        }

        $controller = new $controllerClass;
        $controller->action($actionName);
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
        die;
    }
}