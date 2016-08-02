<?php
session_start();

$userId = $_POST['id'];

if(!empty($userId)) {
    if (!empty($userId)) {
        $_SESSION['id'] = $userId;
        header('Location: viewUserDate.php', true, 301);
    }
    elseif (empty($userId)){
        $_SESSION['invalid_id'] = '<p>Пожалуйста введите корректный id</p>';
        header('Location: index.php', true, 301);
    }
}
