<html>
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<div class="container">
    <table class="table table-striped">
        <?php
        $i = 0; // задаем 0 для итерации
        $data = array(); // массив в который заложим данные из файла csv

        if (($info_csv = fopen("table_info.csv", "r")) !== FALSE) { //Считываем информацию с csv и заодно выполняем проверку на наличие данных
                while (($get_csv = fgetcsv($info_csv, 500, ";")) !== FALSE) { //Пока данные в csv есть будем выполнять итерацию
                    array_push($data, $get_csv); // все полученные данные заложим в массив
                    ?>
                    <tr><td><?= $data[$i][0] ?></td><td><?= $data[$i][1] ?></td><td><?= $data[$i][2] ?></td></tr>
                    <?php
                    $i++; // Увеличиваем значение переменной чтобы вывести следующий ключь массива
                }
            fclose($info_csv); //Закрываем csv файл
        }
        else { // Если данных  нет выводим сообщение
            echo 'Информации не найдено';
        }
        ?>
    </table>
</div>
</body>
</html>
