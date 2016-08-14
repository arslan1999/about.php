<?php
class NewsCore extends NoteCore
{
    public function getAllPost(){

        return parent::getAllPost();

    }

    public function getOnePost($id = NULL){
            if (file_exists("News/title{$id}.txt") && file_exists("News/{$id}.txt")) {
                $content = file_get_contents("News/{$id}.txt");
                $title = file_get_contents("News/title{$id}.txt");
                return "<h3>{$title}</h3><p>{$content}</p>";
            } else {
                $title = NULL;
                return '<p>Такой записи не существует</p>';
            }
    }
    
}