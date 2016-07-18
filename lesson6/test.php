<!DOCTYPE html>
<?php
$get_json = $_GET['json'];
$file = __DIR__.'/json/1.json';
$get_data = file_get_contents($file);
$json_array = json_decode($get_data, true);
$i = 0;
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Отправка файла на сервер</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center center-block">
    <form action="" method="get" enctype="multipart/form-data">
        <div class="form-group has-success">
            <?php
            foreach ($json_array as $value){
                    if ($get_json == $value['id']){
                        echo 'Пока не тест не выводиться но скоро будет';
                        exit;
                    }
            }
            ?>
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
