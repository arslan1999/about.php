<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 19:47
 */

error_reporting(E_ALL);
require_once "note.class.php";
require_once "news.class.php";

if (isset($_GET['id'])) $id = (int) $_GET['id'];

$news = new News($id);
echo "<h2>".$news->title."</h2>";
echo $news->content;