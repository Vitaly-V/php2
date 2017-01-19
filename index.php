<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$view = new \App\View();
$view->news = \App\Models\Article::findAll();

echo $view->render(__DIR__ . DS . 'App' . DS . 'Templates' . DS . 'index.php');