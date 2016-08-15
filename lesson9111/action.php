<?php
session_start();
require_once "profile.class.php";
$userId = $_POST['id'];

if(!empty($userId)) {
    $_SESSION['id'] = $userId;
    $userData = new Profile($_SESSION['id']);
    if ($userData->name === null && $userData->surname === null && $userData->photo === null && $userData->city === null){
        $_SESSION['invalid_id'] = '<p>Введен либо не коректный id либо пользователь был удален!</p>';
        header('Location: index.php', true, 301);
        exit;
    }
    header('Location: viewUserDate.php', true, 301);
    exit;
}
if(empty($userId)){
    $_SESSION['empty-value'] = '<label for="id">Введите id в поле для ввода!!! Не оставляйте поле пустым</label>';
    header('Location: index.php', true, 301);
    exit;
}
