<?php

mb_internal_encoding("utf-8");




$regions = array( // Исходный массив

    "Орловская область" => array("Орел", "Болхов",  "Дмитровск"),
    "Московская область" => array("Москва", "Павловский-Посад", "Сергиев-Посад"),
    "Краснодарский край" => array("Горячий-Ключ", "Белореченск", "Усть-Лабинск")

);

$city_name = array(); // массив в который добавим названия с двумя словами

foreach($regions as $region => $city_array) { // раскладываем ключи и их вложеные массивы по переменным
    $region_name = $region;

    foreach ($city_array as $v) { // значения вложеных масивов заложим в переменную

        trim($v);//Очищаем значения от пробелов побокам

        if (strpos($v, '-') !== false) { // выполняем проверку на пробелы в значениях вложеных массивов

            array_push($city_name, $v);// если результат не Ложный тогда добавим эти значения в отдельный массив

        }

    }

}
$str_funny_city_name = implode("-", $city_name);// Распилим массив с двойными названиями
$funny_city_name = explode("-", $str_funny_city_name);// и соберем обратно только каждой части присвоим свой ключ

$funny_names_second = array();
$funny_names_first = array();

foreach ($funny_city_name as $k_name => $v_name){
    if($k_name % 2 !=0){
        array_push($funny_names_second, $v_name);
    }
    else{
        array_push($funny_names_first, $v_name);
    }
}
shuffle($funny_names_second);
shuffle($funny_names_first);
?>
<table>
    <tr>
        <td>
<?php
$region_key = array_keys($regions);
foreach ($funny_names_first as $funny_name_first){
    if($funny_name_first=='Сергиев' || $funny_name_first=='Павловский'){
        echo $region_key[1];
    }
    elseif($funny_name_first=='Горячий'|| $funny_name_first=='Усть'){
        echo $region_key[2];
    }
    echo ' '.$funny_name_first.'<br/>';
    continue;
}?>
        </td>
        <td>
<?php
foreach ($funny_names_second as $funny_name_second){
    echo $funny_name_second.'<br/>';
    continue;
}?>
        </td>
    </tr>
</table>


