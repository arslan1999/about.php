<?php
mb_internal_encoding('utf-8');

$i=1; // переменная для итерирования незнаю как правельней сказать :D

$img_info = array(); // пустой массив в который запишем данные

$file_csv = 'info.csv'; // для удобства записываем название документа csv
$file_info_csv = fopen($file_csv, 'w'); // открываем сsv файл для записи какойто информации

while (file_exists("img/{$i}.jpg")){ // выполняем проверку "Пока в папке есть файлы с названием 1.jpg и так далее до последнего"
                                      // мы будем выполнять скрипт
    echo "Файл {$i}.jpg Есть</br>"; //для проверки выводим сообщение

    $img = "img/{$i}.jpg"; // задаем переменной путь до файла для удобства
    $img_dist = "img/{$i}копия.jpg"; //путь для коппирования
    $img_new_name = "img/{$i}_small.jpg"; //Название для изменения названия скопированной картинки
    $small_img = copy($img, $img_dist); // копирование картинок для превьюшек
    $small_img_rename = rename($img_dist, $img_new_name); // меняем название :D

    $percent = 0.18; // во сколько раз уменьшим картинку

    list($width, $height) = getimagesize($img_new_name); // получаем ширину и высоту
    $new_width = $width * $percent; // новая ширина
    $new_height = $height * $percent; // новая высота

    $image_p = imagecreatetruecolor($new_width, $new_height); // создаем картинку
    $image = imagecreatefromjpeg($img_new_name); // читаем картинку из имени файла
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); // создаем уменьш картинку

    imagejpeg($image_p, $img_new_name, 100);


    array_push($img_info, array( // записываем массив из данных файла в массив File_info
         $img, // путь до карттинки
         $img_new_name, //путь до маленькой картинки
         date ("F d Y H:i:s.", filemtime($img)), // Дата изменения
         filesize($img) // размер картинки
        ));
    $i++; // увеличиваем переменную чтобы провести все операции с следующим файлом

}
foreach ($img_info as $value_array){ // все вложенные массивы записываем в переменную $value_array

        fputcsv($file_info_csv, $value_array); //И с каждой итерацией записываем данные в csv файл

}

fclose($file_info_csv); // После записи данных в csv файл  закрываем его
?>

<a href="http://university.netology.ru/user_data/hisamutdinov/lesson4/view.php">Перейдите =D</a>


