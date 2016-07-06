<?php

mb_internal_encoding("utf-8");

$regions = array( // Исходный массив

    "Орловская область" => array("Орел", "Болхов",  "Дмитровск"),
    "Московская область" => array("Москва", "Павловский-Посад", "Сергиев-Посад"),
    "Краснодарский край" => array("Горячий-Ключ", "Белореченск", "Усть-Лабинск")

);

$city_name = array(); // массив в который добавим названия с двумя словами

foreach($regions as $region => $city_array) { // раскладываем ключи и их вложеные массивы по переменным

    foreach ($city_array as $v) { // значения вложеных масивов заложим в переменную

        trim($v);//Очищаем значения от пробелов побокам

        if (strpos($v, '-') !== false) { // выполняем проверку на пробелы в значениях вложеных массивов

            array_push($city_name, $v);// если результат не Ложный тогда добавим эти значения в отдельный массив

        }

    }

}
$str_funny_city_name = implode("-", $city_name);// Распилим массив с двойными названиями
$array_funny_city_name = explode("-", $str_funny_city_name);// и соберем обратно только каждой части присвоим свой ключ
?>
<pre>
    <?php var_dump($array_funny_city_name);// выводим на экран для проверки.. можно удалить эту строку она не важна ?>
</pre>
<ul>
<?php
if (is_array($array_funny_city_name) === true){ //выполняем поиск значений в массиве если истина то....
    $region_key = array_keys($regions); // сохраняем ключи главного массива этим дадим им своего рода индетификатор =))
    ?>
    <li><?= $region_key[1].' '.$array_funny_city_name[2].' '.$array_funny_city_name[4]; ?></li><!-- Эту часть неуспел доработать -->
    <li><?= $region_key[2].' '.$array_funny_city_name[6].' '.$array_funny_city_name[7]; ?></li> <!-- дел было много -->
    <li><?= $region_key[2].' '.$array_funny_city_name[4].' '.$array_funny_city_name[0]; ?></li>
    <li><?= $region_key[1].' '.$array_funny_city_name[0].' '.$array_funny_city_name[5]; ?></li>
    <li><?= $region_key[2].' '.$array_funny_city_name[7].' '.$array_funny_city_name[2]; ?></li>
    <li><?= $region_key[1].' '.$array_funny_city_name[2].' '.$array_funny_city_name[7]; ?></li>
    <li><?= $region_key[2].' '.$array_funny_city_name[4].' '.$array_funny_city_name[3]; ?></li>
    <li><?= $region_key[1].' '.$array_funny_city_name[0].' '.$array_funny_city_name[0]; ?></li>
<?php }
else{
    echo 'Простите в массиве не нашлось забавных названий городов';
}
?>
</ul>
