<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . '..' . DS . 'autoload.php';

$article = \App\Models\Article::findById($_GET['id']);

if ($article) {
    include __DIR__ . DS . '..' . DS . 'App' . DS . 'Templates' . DS . 'admin' . DS . 'edit.php';
} else {
    header('Location: /index.php');
}