<!DOCTYPE html>
<?php
$get_id = @$_GET['json'];
$get_answer = @$_GET['answer'];
$get_user = @$_GET['user_name'];
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
            $array_id = array();
            foreach ($json_array as $value){
                if ($get_id == $value['id']){
                    if(isset($get_answer)) {
                        if ($get_answer == $value['answer']) {
                            $mark = 'Ответил';
                        }
                        elseif ($get_answer != $value['answer'] && $get_answer != false) {
                            $mark = 'Не ответил';
                        }
                        else{
                            $mark = 'Неизвестая';
                        }
                        $user_name = !empty($get_user) ? $get_user : 'Гость';
                        ?>
                        <img src="image_create.php?user_name=<?= $user_name ?>&mark=<?= $mark ?>">
                        <?php
                        exit;
                    }
                        ?>
                    <input title="" type="hidden" name="json" value="<?= $value['id'] ?>">
                    <label class="control-label" for="inputSuccess1"><?= $value['question'] ?></label><br/>
                    <input title="" type="text" name="answer"><br/>
                    <label class="control-label" for="inputSuccess1">Введите имя пользователя</label><br/>
                    <input title="" type="text" name="user_name">
                    <input type="submit" value="Отправить">
                    <?php
                    exit;
                }
                array_push($array_id, $value['id']);
            }
            if(array_search($get_id, $array_id) != true && $get_id != false){
                http_response_code(404);
                exit;
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