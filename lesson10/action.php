<?php
session_start();

define('ADMIN_LOGIN', 'admin');
define('ADMIN_PASSWORD', 'pass');

if (isset($_POST['destroy-session'])){
    unset($_SESSION['login']);
    unset($_SESSION['pass']);
    session_destroy();
    header('Location: index.php', true, 301);
    exit;
}
if (isset($_POST['User'])){
    $userData = $_POST['User'];
}

if(ADMIN_LOGIN === $userData['login'] && ADMIN_PASSWORD === $userData['password']){
    $_SESSION['pass'] = $userData['password'];
    $_SESSION['login'] = $userData['login'];
    header('Location: feed.php', true, 301);
    exit;
}
else{
    $_SESSION['invalid_login'] = '<p>Пожалуйста заполните все поля коректно</p>';
    header('Location: index.php', true, 301);
    exit;
}