<?php
session_start();
require_once 'edit.class.php';
$db = new task();
if(isset($_POST['done_is']) && is_numeric($_POST['done_is']) && isset($_POST['id']) && is_numeric($_POST['id'])){
    $db->updateMoreNotes($_POST['id'], $_POST['done_is']);
}
if(isset($_POST['authors']) && isset($_POST['task_id'])){
    $a = htmlspecialchars(trim($_POST['authors']));
    $b = htmlspecialchars(trim($_POST['task_id']));
    $db->refactTask($a, $b);
    $_SESSION['status'] = 'Задача успешно перекданна';
    header('Location: table.php', true, 301);
    exit;
}
else{
    $_SESSION['status'] = 'Ошибка задача не переданна';
    header('Location: table.php', true, 301);
    exit;
}
