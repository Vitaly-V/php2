<?php

namespace App;

abstract class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    // I decided to move access method to the Admin controller. I think that Admin controller is better place for such method. What do you think about it?

    public function action($name)
    {
        $action = 'action' . $name;
        $this->$action();
    }

}