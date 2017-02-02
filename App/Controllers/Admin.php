<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Tools\WebsiteTools;


class Admin extends Controller
{

    public function actionIndex()
    {
        $this->view->news = Article::findAll();
        $this->view->authors = Author::findAll();
        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . 'admin' . DS . 'index.php'
        );
    }

    public function actionEdit()
    {
        $this->view->article = Article::findById($_GET['id']);
        $this->view->authors = Author::findAll();
        echo $this->view->render(
            __DIR__ . DS . '..' . DS . 'Templates' . DS . 'admin' . DS . 'edit.php'
        );
    }

    public function actionSave()
    {
        if (empty($_POST['id'])) {
            $article = new \App\Models\Article();
        } else {
            $article = \App\Models\Article::findById($_POST['id']);
        }
        $article->title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $article->text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        $article->author_id = filter_var($_POST['author_id'], FILTER_SANITIZE_NUMBER_INT);
        $article->save();
        WebsiteTools::redirect('/admin?access=admin');
    }

    public function actionDelete()
    {
        $article = \App\Models\Article::findById($_GET['id']);
        $article->delete();
        WebsiteTools::redirect('/admin?access=admin');
    }

    protected function access(): bool
    {
        return (!empty($_GET['access']) && 'admin' === $_GET['access']);
    }

}