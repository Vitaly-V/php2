<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\Router;

class Admin extends Controller
{

    public function action($name)
    {
        if ($this->access()) {
            parent::action($name);
        } else {
            die('Access denied');
        }
    }

    protected function access(): bool
    {
        return (!empty($_GET['access']) && 'admin' === $_GET['access']);
    }

    public function actionIndex()
    {
        $this->view->news = Article::findAll();
        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . 'admin' . DS . 'index.php'
        );
    }

    public function actionEdit()
    {
        $this->view->article = Article::findById($_GET['id']);
        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . 'admin' . DS . 'edit.php'
        );
    }

    public function actionSave()
    {
        if (!empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['author'])) {
            if (empty($_POST['id'])) {
                $article = new \App\Models\Article();
            } else {
                $article = \App\Models\Article::findById($_POST['id']);
            }
            $author = $this->getAuthor(filter_var($_POST['author'], FILTER_SANITIZE_STRING));
            $article->title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $article->text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
            $article->author_id = $author->id;
            $article->save();
            Router::redirect('/admin?access=admin');
        }
    }

    protected function getAuthor(string $fullName): \App\Models\Author
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

    public function actionDelete()
    {
        $article = \App\Models\Article::findById($_GET['id']);
        $article->delete();
        Router::redirect('/admin?access=admin');
    }

}