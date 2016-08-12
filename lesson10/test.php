<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 19:40
 */
error_reporting(E_ALL);
require_once "note.class.php";
require_once "news.class.php";
$news = new News();

$news->title = "Сенсация!!";
$news->content = "Сенсационно прошло занятие по ООП в Нетологии!";
$news->save();
?>