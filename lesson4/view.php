<?php
$i = 0; // задаем 0 для итерации
$data = array(); // массив в который заложим данные из файла csv

if (($info_csv = fopen("info.csv", "r")) !== FALSE) { //Считываем информацию с csv и заодно выполняем проверку на наличие данных

    ?>
    <ul>
    <?php
    while (($get_csv = fgetcsv($info_csv, 500, ",")) !== FALSE) { //Пока данные в csv есть будем выполнять итерацию
        array_push($data, $get_csv); // все полученные данные заложим в массив

        ?>

        <li><a href="<?= $data[$i][0] ?>" target="_blank"><img src="<?= $data[$i][1] ?>">Картинка: дата последнего изменения <?= $data[$i][2] ?> размер <?= $data[$i][3] ?> </a></li>
<!-- Создаем ссылки на картинки и превью -->
        <?php
        $i++; // Увеличиваем значение переменной чтобы вывести следующий ключь массива
    }
    ?>
    </ul>
    <a href="http://university.netology.ru/user_data/hisamutdinov/lesson4">Вернуться</a>
    <?php
    fclose($info_csv); //Закрываем csv файл
}
else { // Если данных  нет выводим сообщение
    echo 'Информации о файлах не найдено';
}