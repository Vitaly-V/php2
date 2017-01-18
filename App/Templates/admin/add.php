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
    <form name="add" method="post" action="admin.php">
        <div class="title"><b>Title:</b><br>
            <input name="title" type="text">
        </div>
        <div class="text"><b>Text</b><Br>
            <textarea name="text"></textarea>
        </div>
        <div class="title"><b>Title:</b><br>
            <input name="author" type="text">
        </div>
        <div>
            <input type="submit" value="Publish">
        </div>
    </form>
</div>
</body>
</html>