<?php

namespace App\Tools;

class WebsiteTools
{

    /**
     * @param string $location
     */
    public static function redirect($location = '/')
    {
        header('Location: ' . $location);
        die;
    }

    /**
     * @param $url
     * @return array
     */
    public static function getUrlPathArray($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        return explode('/', trim($path));
    }

    /**
     * @param $fileName
     */
    public static function createFile($fileName)
    {
        if (!file_exists($fileName)) {
            $res = fopen($fileName, 'a');
            fclose($res);
        }
    }

}