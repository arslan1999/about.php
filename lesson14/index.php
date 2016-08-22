<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Лента</title>
    <link rel="stylesheet" href="efect/style.css">
</head>
<body>
<div class="container" style="padding-top: 95px;border: 2px solid darkcyan">
    <?php
    if (!empty($_SESSION['invalid_login'])){
        echo $_SESSION['invalid_login'];
        unset($_SESSION['invalid_login']);
        session_destroy();
    }

    ?>
    <form action="action.php" method="POST">
        <?php if(empty($_SESSION['login'])){ ?>
        <div class="form-group has-success">
            <div class="form-group">
                <label for="login">Введите логин</label>
                <input class="form-control" id="login" name="User[login]"></div>
            <div class="form-group">
                <label for="password">Введите пароль</label>
                <input class="form-control" id="password" type="password" name="User[password]">
            </div>
            <input id="submit" class="btn btn-success" type="submit" value="Войти">
            <label for="submit">Если вы не до сих пор не зарегистрированны система вас зарегистрирует автоматически</label>
            <?php } ?>
            <?php if(!empty($_SESSION['login'])){ ?>
                <input class="btn btn-danger" type="submit" name="destroy-session" value="Выйти">
            <?php } ?>
        </div>
    </form>
</div>
</body>
</html>