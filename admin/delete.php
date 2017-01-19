<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . '..' . DS . 'autoload.php';

$article = \App\Models\Article::findById($_GET['id']);

if ($article instanceof \App\Models\Article) {
    $article->delete();
}

header('Location: /admin/index.php');
