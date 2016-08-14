<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 19:47
 */

error_reporting(E_ALL);
require_once "autoload.php";

spl_autoload_register("interfaceAutoload");
spl_autoload_register("classAutoload")

?>
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
                <li><a href="news.php">Новости</a></li>
                <li><a href="article.php">Записи</a></li>
                <li><a href="image.php">Картинки</a></li>
            </ul>
        </div>
    </nav>
    <?php
    if(empty($_SESSION['login'])){
        http_response_code(403);
        echo '<p>Доступ закрыт авторизируйтесь по ссылке</p></br><a href="index.php">Ссылка</a>';
        exit;
    }
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    }
    elseif (!isset($_GET['id'])) {
        $id = null;
    }
    $note = new Note($id);

    if (isset($_POST['content']))
    {
        $note->content = $_POST['content'];
        $note->save();
        if($id !== null) echo '<p> Запись успешно отредактирована </p>';
        if($id === null) echo '<p>Запись успешно сохранена на сервере</p>'; $note->add_to_feed();
    }
    ?>
    <form enctype="multipart/form-data" action="" method="post">
        <div class="form-group">
            <label for="text">Описание картинки</label><br/>
            <textarea class="form-control" rows="3" id="text" title="Текст" name="content"><?= $note->content ?></textarea><br/>
            <input class="btn btn-default" type="submit" value="Отправить">
        </div>
    </form>
    <table class="table table-hover">
        <thead>
        <tr><td>Id</td><td>Текст</td><td>--------</td></tr>
        </thead>
        <tbody>
        <?php
        $id = 1;
        while (file_exists($note->contentIdPath($id)))
        {?>
            <tr>
                <td><?= $id ?></td>
                <td><?= file_get_contents($note->contentIdPath($id))?></td>
                <td><a class="btn btn-success" href="?id=<?= $id ?>">Редактировать</a> <a class="btn btn-danger" href="article_edit.php"> Перейди к загрузке нового контента</a></td>
            </tr>
            <?php
            $id++;
        }
        ?>
        </tbody>
    </table>

</div>
</body>
</html>

