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
        if (file_exists("note/{$id}.txt")) {
            $content = file_get_contents("note/{$id}.txt");
            return "<p>{$content}</p>";
        } else {
            $content = NULL;
            return '<p>Такой записи не существует</p>';
        }
    }
    public function __call($name, $arguments)
    {
        if(isset($name) ){
            http_response_code(404);
            die("Ошибка 404 такой страницы не существует ({$name})");
        }
    }
}