<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 20:05
 */
error_reporting(E_ALL);
require_once "autoload.php";

spl_autoload_register("interfaceAutoload");
spl_autoload_register("classAutoload");

$addFeed = "feed.json";
$data = file_get_contents($addFeed);
$data = json_decode($data, true);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Лента</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container text-center" style="padding-top: 95px;border: 2px solid darkcyan">
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
    foreach($data as $row)
    {
        $class_name = $row[0];
        $feed_object = new $class_name($row[1]);
        /* @var $feed_object feedable */
        ?>
        <div class="panel panel-primary">
            <?= $feed_object->feed_item();?>
        </div><br/><br/><br/>

        <?php
    }
    ?>
</div>
</body>
 </html>