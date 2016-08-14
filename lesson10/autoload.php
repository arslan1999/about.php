<?php

function classAutoload($name)
{
    $name_file = 'class/' . mb_strtolower($name, 'utf-8') . '.class.php';
    if (file_exists($name_file) ===  true) {
        require_once $name_file;
    }
    elseif (file_exists($name_file) === false){
        die(http_response_code(404)."ошибка 404 такого класса не существует! {$name}");
    }
}
function coreAutoload($name)
{
    $name_file = 'core/' . mb_strtolower($name, 'utf-8').'.php';
    if (file_exists($name_file) ===  true) {
        require_once $name_file;
    }
    elseif (file_exists($name_file) === false){
        die(http_response_code(404)."ошибка 404 такого класса не существует! {$name}");
    }
}
function interfaceAutoload($name)
{
    $name_file = 'interface/' . mb_strtolower($name, 'utf-8').'.interface.php';
    if (file_exists($name_file) ===  true) {
        require_once $name_file;
    }
}
