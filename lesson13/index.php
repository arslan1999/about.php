<?php
require_once 'edit.class.php';

$task = new task();


// Здесь все о добовлении в базу =)

/////////////
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Лента</title>
    <link rel="stylesheet" href="style.css">
    <script language="JavaScript" type="text/javascript" src="jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body><br><br>
<div class="container">

    <?php
    // МОДАЛЬНОЕ ОКНО ДЛЯ ПОДТВЕРЖДЕНИЯ УДАЛЕНИЯ
    if(isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        if(is_numeric($id) && $_GET['delet'] === 'yes') {$task->deleteNote($id);}
        if (is_numeric($id) && !isset($_GET['delet'])){ ?>
            <div style="display: block; padding-left: 0px;" class="modal fade in" id="myModal" tabindex="-1"
                 role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="get" action="">
                                <input type="hidden" name="id" value='<?= $id ?>'/>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="delet" id="optionsRadios1" value="yes">
                                        Да удалить!
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="delet" id="optionsRadios2" value="no">
                                        Нет не надо!
                                    </label>
                                </div>
                                <input type="submit" class="btn btn-success" value='Подтвердить'/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    // МОДАЛЬНОЕ ОКНО ДЛЯ ПОДТВЕРЖДЕНИЯ УДАЛЕНИЯ

    // МОДАЛЬНОЕ ОКНО ДЛЯ ДОБАВЛЕНИЯ НОВОЙ ЗАПИСИ
    if(isset($_POST['do_add'])){

        $task->createNote($_POST['description'], $_POST['done'], date("Y-m-d H:i:s.", time()));
        $f = 'Данные успешно записаны!';
    }
    ?>
    <p><?= $f.'  '.date("Y-m-d H:i:s.", time()) ?></p>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Добавить новую цель</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="">

                        <label for="desc">Описание цели</label>
                        <input id="desc" type="text" name="description"/>

                        <div class="radio">
                            <label>
                                <input type="radio" name="done" id="optionsRadios1" value="1">
                                Выберите этот пункт если цель достигнута
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="done" id="optionsRadios2" value="0">
                                Если цель еще не достигнута выберите этот пункт
                            </label>
                        </div>

                        <input type="hidden" value='do_add' name="do_add"/>
                        <input type="submit" class="btn btn-success" value='Добавить'/>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <button href="#myModal" role="button" class="btn btn-success" data-toggle="modal">Добавить цель =)</button>

    <?php
    // МОДАЛЬНОЕ ОКНО ДЛЯ РЕДАКТИРОВАНИЯ ДАННЫХ
    if(isset($_GET['idedit'])){
        $idedit = htmlspecialchars($_GET['idedit']);
        $note = $task->getOneNotes($idedit);
        if(isset($_GET['idedit']) && isset($_POST['do_edit'])){
            $task->updateNote($idedit, $_POST['descriptionEdit'], $_POST['doneEdit'], date("Y-m-d H:i:s.", time()));
        }
        elseif(isset($_GET['idedit']) && !isset($_POST['do_edit'])) {
            ?>
            <div style="display: block; padding-left: 0px;" class="modal fade in" id="edit" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Отредактировать</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <label for="desc">Описание цели</label>
                                <input id="desc" name="descriptionEdit" type="text" value="<?= $note ?>">
                                <div class="radio">
                                    <label>
                                        <input name="doneEdit" id="optionsRadios1" value="1" type="radio">
                                        Выберите этот пункт если цель достигнута
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input name="doneEdit" id="optionsRadios2" value="0" type="radio">
                                        Если цель еще не достигнута выберите этот пункт
                                    </label>
                                </div>
                                <input value="do_edit" type="hidden" name="do_edit">
                                <input class="btn btn-success" value="Редактировать" type="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <!-- Вывод данных -->
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td>Описание</td>
            <td>Состояние))</td>
            <td>Дата</td>
            <td>+ + +</td>
            <td>- - -</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($task->getAllNotes() as $row) { ?>
            <tr>
                <td><?= $row['description'] ?></td>
                <td>
                    <?php
                    if($row['is_done'] == 0){echo '<p style="color:royalblue;">Выполняется:)</p>';}
                    else{echo '<p style="color:#31b0d5;">Выполнено!! :)</p>';}
                    ?>
                </td>
                <td><?= $row['date_added'] ?></td>
                <td><a class="btn btn-danger" href="?id=<?=$row['id']?>">Удалить</a></td>
                <td><a href="?idedit=<?=$row['id']?>" class="btn btn-success">Изменить</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
