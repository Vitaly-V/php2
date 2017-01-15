<?php

namespace App;

trait TSingleton
{

    protected static $instance;

    protected function __construct()
    {
    }

    public static function getInstance(...$args)
    {
        if (null === static::$instance) {
            static::$instance = new static(...$args);
        }

        return static::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}