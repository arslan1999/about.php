<?php
session_start();
require_once "profile.class.php";


if(empty($_SESSION['invalid_id'])) {
    $userData = new Profile($_SESSION['id']);

    if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['city'])) {

        $userData->editProfile($_POST['name'], $_POST['surname'], $_POST['city']);

    }

}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список json файлов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center center-block">
    <p>Если есть желание отредактировать ваши данные. То можете его исполнить с помощью формы =)</p>
    <form method="post" action="">

        <label for="name">Ваше имя</label>
        <input id="name" type="text" value="<?= $userData->name ?>" name="name">

        <label for="surname">Ваше имя</label>
        <input id="surname" type="text" value="<?= $userData->surname ?>" name="surname">

        <label for="city">Ваше имя</label>
        <input id="city" type="text" value="<?= $userData->city ?>" name="city">

        <button class="btn btn-success">Отправить</button>
    </form>
</div>
</body>
</html>