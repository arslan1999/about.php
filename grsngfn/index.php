<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список json файлов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center center-block">
    <?php
    if (!empty($_SESSION['invalid_login'])){
        echo $_SESSION['invalid_login'];
        unset($_SESSION['invalid_login']);
    }
    ?>
    <form action="action.php" method="POST">
        <div class="form-group has-success">

            <label for="login">Введите логин</label>
            <input id="login" name="User[login]">

            <label for="password">Введите пароль</label>
            <input id="password" type="password" name="User[password]">

            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
</body>
</html>
