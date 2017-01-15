<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$article = \App\Models\Article::findById((int)$_GET['id']);

if ($article) {
    include __DIR__ . DS . 'App' . DS . 'Views' . DS . 'Article.php';
} else {
    header('Location: /index.php');
}