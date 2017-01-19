<?php

namespace App;

class Config
{

    use TSingleton;

    public $data = [];

    protected function __construct($path)
    {
        $this->data = include $path;
    }
}
