<?php

class task
{

    public static function getAllNotes()
    {
        $pdo = new PDO("mysql:host=localhost; dbname=task", "admin", "123123");
        $sql = "SELECT id, description, is_done, date_added FROM tasks";

        return $pdo->query($sql);

    }

    public static function getOneNotes($id)
    {
        $pdo = new PDO("mysql:host=localhost; dbname=task", "admin", "123123");
        $sql = "SELECT id, description FROM tasks WHERE id = $id LIMIT 1";
        $query = $pdo->prepare($sql);

        foreach ($pdo->query($sql) as $value){
            $desc = $value['description'];
        }
        return $desc;
    }

    public static function createNote($description, $is_done, $date_added)
    {
        $pdo = new PDO("mysql:host=localhost; dbname=task", "admin", "123123");
        $sql = "INSERT INTO tasks (description, is_done, date_added) VALUES (:description, :is_done, :date_added)";
        $query = $pdo->prepare($sql);
        $query->execute(
            array(
                ':description' => $description,
                ':is_done' => $is_done,
                ':date_added' => $date_added
            )
        );
        if ($query->rowCount() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function updateNote($id, $description, $is_done, $date_added)
    {


        $pdo = new PDO("mysql:host=localhost; dbname=task", "admin", "123123");
        $sql = "UPDATE tasks SET description = :description, is_done = :is_done, date_added = :date_added WHERE id = :id LIMIT 1";
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

    public static function deleteNote($id)
    {
        $pdo = new PDO("mysql:host=localhost; dbname=task", "admin", "123123");
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