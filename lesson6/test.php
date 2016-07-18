<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Отправка файла на сервер</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center center-block">
    <form action="list.php" method="get" enctype="multipart/form-data">
        <div class="form-group has-success">
            <label class="control-label" for="inputSuccess1">Напишите id теста</label><br/>
            <input title="" type="text" name="json">
            <input type="submit" value="Отправить">
        </div>
    </form>
    <a href="admin.php">Добавить тест</a><br/>
    <a href="list.php">Список тестов</a>
</div>
</body>
</html>