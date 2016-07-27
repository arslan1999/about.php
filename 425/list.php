<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Список json файлов</title>
     <link rel="stylesheet" href="style.css">
 </head>
 <body>
 <div class="container text-center center-block">
     <table class="table table-hover">
     <?php
     $file = __DIR__.'/json/1.json';
     $get_data = file_get_contents($file);
     $json_array = json_decode($get_data, true);

     foreach ($json_array as $key => $value){ ?>
             <tr>
                 <td>
                     <a href="test.php?id_get=id_get&json=<?= $value['id'] ?>" class="btn-danger" style="padding:10px 35px;"><?= 'Тест №'.$value['id'] ?></a>
                 </td>
             </tr>

         <?php
     }
     ?>
     </table>
     <a href="admin.php">Добавить тест</a><br/>
     <a href="test.php">Выбрать тест для прохождения</a>
</div>
</body>
</html>