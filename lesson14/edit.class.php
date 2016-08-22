<?php
require_once 'configurate.php';
class task
{
    //Получение всех саписей пользователя
    public static function getAllNotes($sort, $authorId)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        if ($sort == 'sort-date'){$type = "ORDER BY tasks.date_added";}
        elseif ($sort == 'sort-desc'){$type = "ORDER BY tasks.description";}
        elseif ($sort == 'sort-done'){$type = "ORDER BY tasks.is_done";}
        else{$type = null;}
        $sql = "
                SELECT tasks.* , authors.author_name
                FROM tasks  
                INNER JOIN authors ON authors.id = tasks.author_id
                WHERE tasks.author_id = $authorId
                $type";
        return $pdo->query($sql);
    }
    // Получение переданных заданий
    public static function getMoreNotes($authorId)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "
                SELECT tasks.* , authors.author_name
                FROM tasks  
                INNER JOIN authors ON authors.id = tasks.author_add_id 
                WHERE tasks.author_add_id  = $authorId ";
        return $pdo->query($sql);
    }
    // Редактирование статуса переданных заданий
    public static function updateMoreNotes($id, $is_done)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "UPDATE tasks 
                SET is_done = :is_done
                WHERE id = $id LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':is_done' => $is_done,
            )
        );
        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }
    //Получение одной записи
    public static function getOneNotes($id)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "SELECT id, description 
                FROM tasks 
                WHERE id = $id LIMIT 1";
        foreach ($pdo->query($sql) as $value){
            $desc = $value['description'];
        }
        return $desc;
    }
    //Создание записи
    public static function createNote($description, $is_done, $date_added, $authorId)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "INSERT INTO tasks (description, is_done, date_added, author_id ) 
                VALUES (:description, :is_done, :date_added, :author_id )";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':description' => $description,
                ':is_done' => $is_done,
                ':date_added' => $date_added,
                ':author_id' => $authorId
            )
        );
        if ($query->rowCount() == 1) {
            return true;
        }
        else {
            return false;
        }
    }
    //Провенрка на существование пользователя в бд
    public static function emptyNameAuthor($name, $pass){
        $pdo = new PDO("mysql:host=" . __HOST__ . "; dbname=" . __LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "SELECT author_name, author_password 
                FROM authors 
                WHERE author_name = '$name' AND author_password = '$pass'";
        $query = $pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_COLUMN);

    }
    // Получение всех авторов
    public static function getAuthors($notId){
        $pdo = new PDO("mysql:host=" . __HOST__ . "; dbname=" . __LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "SELECT author_name, id
                FROM authors
                WHERE id != $notId";
        return $pdo->query($sql);

    }
    //Добовление ауди польз при передаче задания
    public static function refactTask($author_add_id, $id)
    {
        $pdo = new PDO("mysql:host=" . __HOST__ . "; dbname=" . __LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "UPDATE tasks 
                SET author_add_id = :author_add_id
                WHERE id = $id LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':author_add_id' => $author_add_id,
            )
        );
        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }
    //Добовление пользователя в бд
    public static function createAuthors($name, $pass)
    {
        $pdo = new PDO("mysql:host=" . __HOST__ . "; dbname=" . __LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "INSERT INTO authors (author_name, author_password) 
                VALUES (:author_name, :author_password)";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':author_name' => $name,
                ':author_password' => $pass,
            )
        );
        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }
    //Метод получения айди пользователя
    public static function getUserId($name, $pass){
        $pdo = new PDO("mysql:host=" . __HOST__ . "; dbname=" . __LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "SELECT id
                FROM authors 
                WHERE author_name = '$name' AND author_password = '$pass'";
        $query = $pdo->query($sql);
        foreach ($query as $value){
            $id = $value['id'];
        }
        return $id;
    }
//редактирование записи
    public static function updateNote($id, $description, $is_done, $date_added)
    {


        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "UPDATE tasks 
                SET description = :description, is_done = :is_done, date_added = :date_added 
                WHERE id = :id LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':id' => $id,
                ':description' => $description,
                ':is_done' => $is_done,
                ':date_added' => $date_added
            )
        );

        if ($query->rowCount() == 1) {
            return true;
        }

        return false;

    }
//Удалиение записи
    public static function deleteNote($id)
    {
        $pdo = new PDO("mysql:host=".__HOST__."; dbname=".__LOGIN__, __LOGIN__, __PASSWORD__);
        $sql = "DELETE FROM tasks WHERE id = :id LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute
        (
            array(
                ':id' => $id,
            )
        );

        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }
}