<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Лента</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="padding-top: 95px;border: 2px solid darkcyan">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <?php if(!empty($_SESSION['login'])){ ?>
                    <li><a href="image_edit.php">Перейти к изображениям</a></li>
                    <li><a href="article_edit.php">Перейти к записям</a></li>
                    <li><a href="news_edit.php">Перейти к новостям</a></li>
                <?php } ?>
                <li><a href="feed.php">Список всех постов</a> </li>
                <li><a href="index.php">Авторизация</a> </li>
            </ul>
        </div>
    </nav>
    <?php
    if (!empty($_SESSION['invalid_login'])){
        echo $_SESSION['invalid_login'];
        unset($_SESSION['invalid_login']);
        session_destroy();
    }
    
    ?>
    <form action="article.php" method="POST">
        <?php if(empty($_SESSION['login'])){ ?>
        <div class="form-group has-success">
            <div class="form-group">
                <label for="login">Введите логин</label>
                <input class="form-control" id="login" name="User[login]"></div>
            <div class="form-group">
                <label for="password">Введите пароль</label>
                <input class="form-control" id="password" type="password" name="User[password]">
            </div>
            <input class="btn btn-success" type="submit" value="Войти">
            <?php } ?>
            <?php if(!empty($_SESSION['login'])){ ?>
            <input class="btn btn-danger" type="submit" name="destroy-session" value="Выйти">
            <?php } ?>
        </div>
    </form>
</div>
</body>
</html>