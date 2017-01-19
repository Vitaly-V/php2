<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . '..' . DS . 'autoload.php';

$news = \App\Models\Article::findAll();

include __DIR__ . DS . '..' . DS . 'App' . DS . 'Templates' . DS . 'admin' . DS . 'index.php';
