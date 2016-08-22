<?php
session_start();
if(empty($_SESSION['login']) && empty($_SESSION['pass'])){
    http_response_code(403);
    echo '<p>Доступ закрыт авторизируйтесь по ссылке</p></br><a href="index.php">Ссылка</a>';
    exit;
}
require_once 'edit.class.php';
error_reporting(2);
$task = new task();

function clear($v){
   return htmlspecialchars(trim($v));
}
// Здесь все о добовлении в базу =)

/////////////
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Лента</title>
    <link rel="stylesheet" href="efect/style.css">
    <script language="JavaScript" type="text/javascript" src="efect/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="efect/bootstrap.min.js"></script>
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

        $task->createNote(clear($_POST['description']), $_POST['done'], date("Y-m-d H:i:s.", time()), $_SESSION['authorId']);
    }
    ?>
    <p><?= date("Y-m-d H:i:s.", time()) ?></p>
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
                                Выполнено
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="done" id="optionsRadios2" value="0">
                                Не выполнено
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
            if(!isset($_POST['doneEdit'])){
                $_POST['doneEdit'] = 0;
            }
            $task->updateNote($idedit, clear($_POST['descriptionEdit']), $_POST['doneEdit'], date("Y-m-d H:i:s.", time()));
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
                                        Выполнено
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input name="doneEdit" id="optionsRadios2" value="0" type="radio">
                                        Не выполнено
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
    <?php
    if(isset($_GET['sort']) && !empty($_GET['sort'])){
        $sort = $_GET['sort'];
    }
    else{
        $sort = null;
    }
    ?>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td><a href="?sort=sort-desc"> Описание </a></td>
            <td><a href="?sort=sort-done">Состояние))</a></td>
            <td><a href="?sort=sort-date">Дата</a></td>
            <td>Добавить</td>
            <td>Удалить</td>
            <td>Передать задачу</td>
        </tr>
        </thead>
        <tbody>
        <?= 'ID Вашего аккаунта: '.$_SESSION['authorId'].' '.$_SESSION['status']?>
        <?php foreach ($task->getAllNotes($sort, $_SESSION['authorId']) as $row) { ?>
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
                <td>
                    <form action="editAuthor.php" method="post">
                        <select name="authors">
                            <?php
                            foreach ($task->getAuthors($_SESSION['authorId']) as $v){
                                ?>
                                <option value="<?= $v['id'] ?>"><?= $v['author_name']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                        <input class="btn btn-info" type="submit" value="Передать заданиее">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <h3>В этой таблице отображаются задания переданные другими авторамиы</h3>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td>Описание</td>
            <td>Состояние</td>
            <td>Изменить</td>
            <td>Дата</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($task->getMoreNotes($_SESSION['authorId']) as $row) { ?>
            <tr>
                <td><?= $row['description'] ?></td>
                    <?php
                    if($row['is_done'] == 0){?>
                        <td><p style="color:royalblue;">Выполняется:)</p></td>
                        <td><form action="editAuthor.php" method="POST">
                            <input name="done_is" type="hidden" value="1">
                            <input name="id" type="hidden" value="<?= $row['id'] ?>">
                            <input type="submit" class="btn btn-info" value="Выполнено!">
                        </form></td>
                    <?php
                    }
                    else{ ?>
                        <td><p style="color:#31b0d5;">Выполнено!! :)</p></td>
                        <td><form action="editAuthor.php" method="POST">
                            <input name="done_is" type="hidden" value="0">
                            <input name="id" type="hidden" value="<?= $row['id'] ?>">
                            <input type="submit" class="btn btn-info" value="Не выполнено!">
                        </form></td>
                    <?php } ?>
                <td><?= $row['date_added'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="index.php">Перейти на страницу авторизации</a>
</div>
</body>
</html>
