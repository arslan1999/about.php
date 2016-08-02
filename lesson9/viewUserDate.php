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
    require_once "city.class.php";
    require_once "profile.class.php";
    if($this->profileExists() === false){
        http_response_code(403);
        echo '<p>Доступ закрыт авторизируйтесь по ссылке</p></br><a href="index.php">Ссылка</a>';
        exit;
    }
    elseif($this->profileExists() === true){
        $name = new Profile("  ","  ","   ","   ","  ","   ","   ","   ");
        ?>
        <p></p>
        <p></p>
        <p></p>
        <img src="<?=  ?>">
    <?php } ?>
</div>
</body>
</html>
<?php
require_once "city.class.php";
require_once "profile.class.php";

$me = new Profile('shleiko');

echo $me->name;