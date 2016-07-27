<!DOCTYPE html>
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
            if(!empty($_GET['id_get'])) {
                $get_id = $_GET['json'];
                $file = __DIR__ . '/json/1.json';
                $get_data = file_get_contents($file);
                $json_array = json_decode($get_data, true);

                $array_id = array();
                foreach ($json_array as $value) {
                    if ($get_id == $value['id']) {
                        if (!empty($_GET['do_test'])){
                            $get_answer = !empty($_GET['answer']) ? $_GET['answer'] : '';
                            if (!empty($get_answer)) {
                                $user_name = !empty($_GET['user_name']) ? $_GET['user_name'] : 'Гость';
                                if ($get_answer == $value['answer']) {
                                    $mark = 'Ответил';
                                }
                                elseif ($get_answer != $value['answer'] && $get_answer != false) {
                                    $mark = 'Не ответил';
                                }
                                else {
                                    $mark = 'Неизвестно';
                                }
                                ?>
                                <img src="image_create.php?user_name=<?= $user_name ?>&mark=<?= $mark ?>">
                                <?php
                                exit;
                            }
                            else {
                                ?>
                                <label class="control-label" for="inputSuccess1">Введите ответ =)</label><br/>
                                <?php
                            }
                        }
                        ?>
                        <input title="" type="hidden" name="do_test" value="test">
                        <input title="" type="hidden" name="id_get" value="id_get">
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
                if (array_search($get_id, $array_id) != true && $get_id != false) {
                    http_response_code(404);
                    exit;
                }
            }
            ?>
            <input title="" type="hidden" name="id_get" value="id_get">
            <input title="" type="text" name="json" value="Введите id теста">
            <input type="submit" value="Отправить">
        </div>
    </form>
    <a href="admin.php">Добавить тест</a><br/>
    <a href="list.php">Список тестов</a>
</div>
</body>
</html>