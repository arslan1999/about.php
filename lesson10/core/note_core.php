<?php
class NoteCore
{
    public function getAllPost(){

        $addFeed = "feed.json";
        $data = file_get_contents($addFeed);
        $data = json_decode($data, true);
        return $data;

    }

    public function getOnePost($id = NULL){
        if($id !== NULL) {
            if (file_exists("Note/{$id}.txt")) {
                $content = file_get_contents("Note/{$id}.txt");
            } else {
                $content = NULL;
                return '<p>Такой записи не существует</p>';
            }
            return "<p>{$content}</p>";
        }
        else{
            return "<p>Что бы вывести определенную запись необходимо ввести ее id</p>";
        }
    }

    public function __call($name, $arguments)
    {
        if(isset($name) ){
            http_response_code(404);
            die("Ошибка 404 такой страницы не существует");
        }
    }

}