<?php
session_start();
require_once "autoload.php";

spl_autoload_register("coreAutoload");


if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else {
    $id = NULL;
}
if(isset($_GET['post'])){
    $post = $_GET['post'];
}
else{
    $post = NULL;
}
$news_core = new NewsCore();
$i = 1;
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
                    <li><a href="image_edit.php">Изменить изображения</a></li>
                    <li><a href="article_edit.php">Изменить записи</a></li>
                    <li><a href="news_edit.php">Изменить новости</a></li>
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
    if(isset($post)) {
        if ($id !== NULL && $post !== 'getAllPost') {
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Это <?= $id ?> запись</h3>
                </div>
                <div class="panel-body">
                    <p><?= $news_core->$post($id) ?></p>
                </div>
            </div><br/><br/><br/>
            <?php
            echo '<p>Чтобы увидеть определенную запись выберете ее id</p>';
            while (file_exists("News/title{$i}.txt") && file_exists("News/{$i}.txt")){
                ?>
                <a href="news.php?post=getOnePost&id=<?= $i ?>">Перейти к <?= $i ?> посту</a>
                <?php
                $i++;
            }
        }
        elseif ($id === NULL && $post !== 'getOnePost') {
            foreach ($news_core->$post() as $row) {
                if ($row[0] === "News") {
                    if (file_exists("News/title{$row[1]}.txt") && file_exists("News/{$row[1]}.txt")) {
                        $content = file_get_contents("News/{$row[1]}.txt");
                        $title = file_get_contents("News/title{$row[1]}.txt");
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h5 class="panel-title">Это <?= $row[1] ?> запись</h5>

                            </div>
                            <div class="panel-body">
                                <h3 class="panel-title"><?= $title ?></h3>
                                <p><?= $content ?></p>
                            </div>
                        </div><br/><br/><br/>
                        <?php
                    }
                }
            }
        }
        else {
            echo '<p>Чтобы увидеть определенную запись выберете ее id</p>';
            while (file_exists("News/title{$i}.txt") && file_exists("News/{$i}.txt")){
                ?>
                <a href="news.php?post=getOnePost&id=<?= $i ?>">Перейти к <?= $i ?> посту</a>
                <?php
                $i++;
            }
        }
    }
    else{
        ?>
        <p>Перейдите по одной из ссылок если вы хотите просмотреть контент</p>
        <a href="news.php?post=getAllPost">Посмотреть все посты данного раздела</a>
        <a href="news.php?post=getOnePost">Один пост данного раздела выбранный по id</a>
        <?php
    }?>
</div>
</body>
</html>