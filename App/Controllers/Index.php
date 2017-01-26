<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

class Index extends Controller
{

    public function actionIndex()
    {
        $this->view->news = Article::findAll();
        echo $this->view->render(
            __DIR__ . '/../Templates/index.php'
        );
    }

    public function actionArticle()
    {
        $this->view->article = Article::findById($_GET['id']);
        echo $this->view->render(
            __DIR__ . '/../Templates/article.php'
        );
    }

}