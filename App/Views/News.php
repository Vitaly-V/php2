<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
</head>
<body>
<h1>Latest news</h1>
<?php foreach ($news as $article) : ?>
    <div class="article">
        <h3 class="title"><a href="/article.php?id=<?= $article->id; ?>"><?= $article->title; ?></a></h3>
        <div class="text"><?= $article->text; ?></div>
    </div>
<?php endforeach; ?>
</body>
</html>

