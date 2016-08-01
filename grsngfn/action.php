<?php
session_start();

$userData = $_POST['User'];

if(!empty($userData['login']) && !empty($userData['password'])){

    $_SESSION['pass'] = $userData['password'];
    $_SESSION['login'] = $userData['login'];
    header('Location: list.php', true, 301);
}
elseif (!empty($userData['login']) && empty($userData['password'])){
    $_SESSION['pass'] = 0;
    $_SESSION['login'] = $userData['login'];
    header('Location: list.php', true, 301);
}
elseif (empty($userData['login'])){
    $_SESSION['invalid_login'] = '<p>Пожалуйста введите логин</p>';
    header('Location: index.php', true, 301);
}
