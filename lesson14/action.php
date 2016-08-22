<?php
session_start();
require_once 'edit.class.php';
$db = new task();

if (isset($_POST['destroy-session'])){
    unset($_SESSION['login']);
    unset($_SESSION['pass']);
    session_destroy();
    header('Location: index.php', true, 301);
    exit;
}
else {
    if (isset($_POST['User']) && !empty($_POST['User'])) {
        $userData = $userData = $_POST['User'];
    }
    else{
        $userData = null;
    }
    if (mb_strlen($userData['password'], 'utf-8') <= 12 && mb_strlen($userData['login'], 'utf-8') <= 12) {
        if(empty($db->emptyNameAuthor($userData['login'], $userData['password']))) {
            $db->createAuthors(htmlspecialchars(trim($userData['login'])), htmlspecialchars(trim($userData['password'])));

        }
        $_SESSION['pass'] = htmlspecialchars(trim($userData['password']));
        $_SESSION['login'] = htmlspecialchars(trim($userData['login']));
        $_SESSION['authorId'] = $db->getUserId(htmlspecialchars($userData['login']),htmlspecialchars($userData['password']));
        header('Location: table.php', true, 301);
        exit;
    }
    else {
        $_SESSION['invalid_login'] = '<p>Пароль и логин не должны быть больше 12 символов</p>';
        header('Location: index.php', true, 301);
        exit;
    }
}