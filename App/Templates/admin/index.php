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
<a href="admin.php?action=add" id="add">Add article</a>
<div class="news">
    <?php foreach ($news as $article) : ?>
        <div class="article">
            <h3 class="title"><?= $article->title; ?></h3>
            <div class="text"><?= $article->text; ?></div>
            <div class="action-buttons">
                <a href="/admin.php?action=edit&id=<?= $article->id; ?>">Edit</a>
                <a href="/admin.php?action=delete&id=<?= $article->id; ?>">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>