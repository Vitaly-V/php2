<?php

namespace App\Controllers;

use App\Models;
use App\View;

class Article
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function add(string $title, string $text, string $author)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = new Models\Article();
            $article->title = $title;
            $article->text = $text;
            $article->author = $this->getAuthorId($author);
            $this->view->article = $article->save();
            $this->view->render(__DIR__ . '/App/Templates/article.php');
        } else {
            $this->view->render(__DIR__ . '/App/Templates/admin/add.php');
        }

    }

    public function delete(int $id)
    {
        $article = Models\Article::findById($id);
        if ($article instanceof Models\Article) {
           return $article->delete();
        }
        return false;
    }

    public function edit(array $article)
    {

    }

    protected function getAuthorId(string $fullName) :int
    {
        $author = Models\Author::findByFullName($fullName);
        if ($author instanceof Models\Author) {
            return (int) $author->id;
        } else {
            $data = explode(' ', trim($fullName));
            $author = new Models\Author();
            $author->firstname = $data[0];
            $author->lastname = $data[1];
            $author->save();

        }
    }
}