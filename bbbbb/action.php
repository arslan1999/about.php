<?php
session_start();

$userData = $_POST['User'];

if(!empty($userData['login']) && !empty($userData['password'])){
    $file = __DIR__ . '/login.json';
    $get_data = file_get_contents($file);
    $date_user = json_decode($get_data, true);

    foreach ($date_user as $k => $v){
        if ($v['login'] == $userData['login'] && $v['password'] == $userData['password']) {
            $_SESSION['pass'] = $userData['password'];
            $_SESSION['login'] = $userData['login'];
            header('Location: list.php', true, 301) ;
        }
    }
}
elseif (!empty($userData['login']) && empty($userData['password'])){
    $_SESSION['pass'] = 02;
    $_SESSION['login'] = $userData['login'];
    header('Location: list.php', true, 301);
}
elseif (empty($userData['login'])){
    $_SESSION['invalid_login'] = '<p>Пожалуйста введите логин</p>';
    header('Location: index.php', true, 301);
}
