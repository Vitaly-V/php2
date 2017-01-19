<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>
</head>
<body>
<h1>Admin panel</h1>
<div class="news">
    <form name="add" method="post" action="/admin/save.php">
        <div class="title"><b>Title:</b><br>
            <input name="title" type="text">
        </div>
        <div class="text"><b>Text</b><Br>
            <textarea name="text"></textarea>
        </div>
        <div class="author"><b>Author:</b><br>
            <input name="author" type="text">
        </div>
        <div>
            <input type="submit" value="Publish">
        </div>

    </form>

    <?php foreach ($news as $article) : ?>
        <div class="article">
            <h3 class="title"><a href="/article.php?id=<?= $article->id; ?>"><?= $article->title; ?></a></h3>
            <div class="text"><?= $article->text; ?></div>
            <div class="author">Author: <?= $article->author->firstname; ?> <?= $article->author->firstname; ?></div>
            <div class="action-buttons">
                <a href="/admin/edit.php?id=<?= $article->id; ?>">Edit</a>
                <a href="/admin/delete.php?id=<?= $article->id; ?>">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>