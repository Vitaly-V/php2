<?php

namespace App\Controllers;

use App\Controller;

class Error extends Controller
{

    protected $view;

    public function __construct($e)
    {
        parent::__construct();
        $this->view->error = $e->getMessage();
    }

    public function actionNotFound()
    {

        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . '404.php'
        );
    }

    public function actionException()
    {

        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . 'exception.php'
        );
    }


}