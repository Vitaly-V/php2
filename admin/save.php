<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . '..' . DS . 'autoload.php';

if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['author'])) {
    if (empty((int)$_POST['id'])) {
        $article = new \App\Models\Article();
    } else {
        $article = \App\Models\Article::findById($_POST['id']);
    }
    $author = getAuthor(filter_var($_POST['author'], FILTER_SANITIZE_STRING));
    $article->title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $article->text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
    $article->author_id = $author->id;
    $article->save();
}

header('Location: /admin/index.php');
die;

function getAuthor(string $fullName): \App\Models\Author
{
    $author = \App\Models\Author::findByFullName($fullName);
    if ($author instanceof \App\Models\Author) {
        return $author;
    } else {
        $data = explode(' ', trim($fullName));
        $author = new \App\Models\Author();
        $author->firstname = $data[0];
        $author->lastname = $data[1];
        $author->save();
        return $author;

    }
}