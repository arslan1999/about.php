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
        if (file_exists("Note/{$id}.txt")) {
            $content = file_get_contents("Note/{$id}.txt");
            return "<p>{$content}</p>";
        } else {
            $content = NULL;
            return '<p>Такой записи не существует</p>';
        }
    }
    
}