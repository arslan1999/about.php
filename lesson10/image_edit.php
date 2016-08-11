<?php
 session_start();
error_reporting(E_ALL);
require_once "feedable.interface.php";
require_once "note.class.php";
require_once "imageJpg.class.php";
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
    $image = new Image($id);

    if(isset($_FILES['image'])){
    if (preg_match('/\.(?:jpg)$/', $_FILES['image']['name']))
    {
        $image->image = move_uploaded_file($_FILES['image']['tmp_name'], $image->save());
    if(isset($_POST['discription'])){
        $image->discription = $_POST['discription'];
        $image->saveDiscription();
    }
        if($id !== null) echo '<p> Запись успешно отредактирована </p>';
        if($id === null) echo '<p>Запись успешно сохранена на сервере</p>'; $image->add_to_feed();
    }
    else{
        echo '<p>Только json формат</p>';
    die;

    }
    }?>
    <form enctype="multipart/form-data" action="" method="post">
        <div class="form-group">
            <label for="exampleInputFile">Загрузить картинку</label>
            <input type="file" id="exampleInputFile"  name="image">
            <p class="help-block">Только .jpg формат картинок</p>
        </div>
        <div class="form-group">
            <label for="desc">Описание картинки</label><br/>
            <textarea class="form-control" rows="3" id="desc" title="Текст" name="discription"><?= $image->discription ?></textarea><br/>
            <input class="btn btn-default" type="submit" value="Отправить">
        </div>

    </form>

    <table class="table table-hover">
        <thead>
        <tr><td>Id</td><td>Картинка</td><td>Описание картинки</td><td>--------</td></tr>
        </thead>
        <tbody>
        <?php
        $id = 1;
        while (file_exists($image->contentIdPath($id)))
        {?>
            <tr>
                <td><?= $id ?></td>
                <td><img width="150" src="<?= $image->contentIdPath($id)?>"></td>
                <td><?= file_get_contents($image->titleIdPath($id)) ?></td>
                <td><a class="btn btn-success" href="?id=<?= $id ?>">Редактировать</a> <a class="btn btn-danger" href="image_edit.php"> Перейди к загрузке нового контента</a></td>
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
