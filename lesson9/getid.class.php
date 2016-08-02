<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 26.07.2016
 * Time: 19:16
require_once "city.class.php";
require_once "profile.class.php";

$me = new Profile('shleiko');

echo $me->name;
 */

class getUserId
{
    public static function getId(){
        session_start();
        $id = $_SESSION['id'];
        return $id;
    }
    
}
