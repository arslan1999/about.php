<?php

class ImageCore extends NoteCore
{
    public function getAllPost(){

        return parent::getAllPost();

    }

    public function getOnePost($id = NULL){
        if (file_exists("image/discription{$id}.txt") && file_exists("image/{$id}.jpg")) {
            $content = "image/{$id}.jpg";
            $title = file_get_contents("image/discription{$id}.txt");
            return "<h3>{$title}</h3><img src=\"{$content}\">";
        } else {
            $title = NULL;
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