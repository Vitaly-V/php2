<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$editId = false;

if (!empty($_POST['title']) && !empty($_POST['text'])) {
    $article = new \App\Models\Article();
    if (!empty($_POST['id'])) {
        $article->id = (int)$_POST['id'];
    }
    $article->title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $article->text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
    $article->save();
}

if (!empty($_GET['action']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);
    $article = \App\Models\Article::findById($id);
    if (!$article) {
        header('Location: /index.php');
    }
    switch ($action) {
        case 'delete':
            $article->delete();
            break;
        case 'edit':
            $editId = true;
    }
}


$news = \App\Models\Article::findAll();

if ($news) {
    include __DIR__ . DS . 'App' . DS . 'Views' . DS . 'Admin.php';
} else {
    header('Location: /index.php');
}
