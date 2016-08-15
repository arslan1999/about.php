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
    if (!empty($_SESSION['invalid_id'])){
        echo $_SESSION['invalid_id'];
        unset($_SESSION['invalid_id']);
    }
    ?>
    <form action="action.php" method="POST">
        <div class="form-group has-success">

            <?php if(!empty($_SESSION['empty-value'])) {
                echo $_SESSION['empty-value'];
                unset($_SESSION['empty-value']);
             }

            else { ?>
                <label for="id">Введите id пользователя</label>
            <?php } ?>

            <input type="text" id="id" name="id">
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
</body>
</html>