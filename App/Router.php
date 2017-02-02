<?php

namespace App;

use App\Tools\WebsiteTools;

class Router
{

    public static function getRoute($url)
    {
        $urlParts = WebsiteTools::getUrlPathArray($url);
        $controllerName = !empty($urlParts[1]) ? $urlParts[1] : 'Index';
        $route['action'] = !empty($urlParts[2]) ? $urlParts[2] : 'Index';
        $route['controller'] = '\\App\\Controllers\\' . $controllerName;
        if (!class_exists($route['controller'])) {
            return false;
        }
        return $route;
    }
}