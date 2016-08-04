<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
 <head>
  <meta charset="utf-8">
  <title>Отправка файла на сервер</title>
     <link rel="stylesheet" href="style.css">
 </head>
 <body>
 <div class="container text-center center-block">
     <?php
     session_start();
     if(empty($_SESSION['pass'])){
         http_response_code(403);
         echo '<p>Доступ закрыт авторизируйтесь по ссылке</p></br><a href="index.php">Ссылка</a>';
         exit;
     }
     if (isset($_POST['destroy-session'])){
         unset($_SESSION['login']);
         unset($_SESSION['pass']);
         session_destroy();
         header('Location: index.php', true, 301);
     }
     $dir = __DIR__.'/json/'; // путь до дериктории, для получения полного пути вызываем константу __DIR__
     $json = $dir . '1.json'; // путь до файла
     if(isset($_FILES['json'])){ // проверяем получен ли файл
         if(preg_match('/\.(?:json)$/', $_FILES['json']['name'])){ // проверяем формат файла
             if(move_uploaded_file($_FILES['json']['tmp_name'], $json)){ // если файл загружен делаем редирект
                 header('Location: list.php', true, 301); // 301 код редирект на постоянную страницу
             }
             else{ // если по какой то причине файл не загрузился на сервекр выводим сообщение
                 echo '<p>Ошибка</p>';
                 var_dump($_FILES['json']['error']);
                 die;
             }
         }
         else{ // если формат не json выводим сообщение и завершаем работу скрипта
             echo '<p>Только json формат</p>';
             die;
         }
     }
     ?>
      <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group has-success">
              <label class="control-label" for="inputSuccess1">Загрузить json файл</label><br/>
              <input id="inputSuccess1" type="file" name="json" class="center-block">
              <input type="submit" value="Отправить"><br/><br/>
              <input class="btn-success" type="submit" name="destroy-session" value="Разлогинироваться">
          </div>
      </form>

     <a href="list.php">Список всех тестов</a><br/>
     <a href="test.php">Выбрать тест для прохождения</a>
 </div>
 </body>
</html>
