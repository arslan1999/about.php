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
    session_start();
    require_once "profile.class.php";
    
    if(!empty($_SESSION['invalid_id'])){
        http_response_code(403);
        echo '<p>Доступ закрыт авторизируйтесь по ссылке</p></br><a href="index.php">Ссылка</a>';
        exit;
    }
    elseif(empty($_SESSION['invalid_id'])){
        $userData = new Profile($_SESSION['id']);

        if ($userData->name === null) {?><p> Имя пользователем не указанно </p><?php }
        else { ?><p><?= $userData->name ?></p><?php }
        if ($userData->surname === '') {?><p> Фамилия пользователем не указанна </p><?php }
        else { ?><p><?= $userData->surname ?></p><?php }
        if ($userData->city === null) {?><p> Город пользователем не указан </p><?php }
        else { ?><p><?= $userData->city ?></p><?php }
        if ($userData->photo === null) {?><img src="camera_200.png"><?php }
        else {?><img src="<?= $userData->photo ?>"><?php }

    } ?>
<br><br><a href="editedProfile.php">Редактировать данные</a>
</div>
</body>
</html>