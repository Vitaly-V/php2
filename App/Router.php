<?php

namespace App;

use App\Controllers\Error;

class Router
{

    public static function run()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $urlParts = explode('/', $url['path']);
        $controllerName = !empty($urlParts[1]) ? $urlParts[1] : 'Index';
        $actionName = !empty($urlParts[2]) ? $urlParts[2] : 'Index';
        $controllerClass = '\\App\\Controllers\\' . $controllerName;

        try {
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                $controller->action($actionName);
            } else {
                throw new \App\Exceptions\NotFoundException('Route not found');
            }
        } catch (Exceptions\DbException $e) {
            (new Error($e))->action('exception');
        } catch (Exceptions\NotFoundException $e) {
            (new Error($e))->action('notFound');
        }

    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
        die;
    }
}