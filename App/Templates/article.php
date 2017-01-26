<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $article->title ?></title>
</head>
<body>
<div class="article">
    <h3 class="title"><?= $article->title; ?></h3>
    <div class="text"><?= $article->text; ?></div>
    <div class="author">Author: <?= $article->author->firstname; ?> <?= $article->author->firstname; ?></div>
    <div>
        <a href="/">Back to the index page</a>
    </div>
</div>
</body>
</html>