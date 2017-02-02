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
    <form name="add" method="post" action="/admin/save?access=admin">
        <div class="title"><b>Title:</b><br>
            <input name="title" type="text" value="<?= $article->title; ?>">
        </div>
        <div class="text"><b>Text</b><br>
            <textarea name="text"><?= $article->text; ?></textarea>
        </div>
        <div><b>Author: </b></div>
        <div class="author">
            <select name="author_id">
s                <?php foreach ($authors as $author) : ?>
                    <option value="<?= $author->id; ?>"
                        <?php if (isset($article->author_id) && $author->id === $article->author_id): ?>
                            selected="selected"
                        <?php endif; ?>
                    >
                        <?php echo $author->firstname . ' ' . $author->lastname; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <br/>
        <div>
            <input name="id" type="hidden" value="<?= $article->id; ?>">
            <input type="submit" value="Update">
        </div>
    </form>
</div>
</body>
</html>