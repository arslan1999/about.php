<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 20:05
 */
error_reporting(E_ALL);
require_once "feedable.interface.php";
require_once "note.class.php";
require_once "news.class.php";


$data = [
    ['Note', 1],
    ['News', 1],
    ['News', 2],
    ['Note', 2]
];

foreach($data as $row)
{
    $class_name = $row[0];

    $feed_object = new $class_name($row[1]);

    /* @var $feed_object feedable */

    echo $feed_object->feed_item();
}
?>