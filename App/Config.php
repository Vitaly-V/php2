<?php

namespace App;

class Config
{

    use TSingleton;

    public $data = [];

    protected function __construct()
    {
        $this->data = parse_ini_file(__DIR__ . DS . '..' . DS . 'settings.ini', true);
    }
}
