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


}