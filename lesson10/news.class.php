<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 29.07.2016
 * Time: 19:55
 */

class News extends Note implements feedable
{
    public $title;

    public static function storeFolder()
    {
        return 'news';
    }

    public static function titleIdPath($id)
    {
        return static::storeFolder().'/title'.$id.'.txt';
    }

    protected function load()
    {
        $title = file_get_contents(static::titleIdPath($this->id));
        $this->title = $title;
        parent::load();
    }

    public function save()
    {
        $result = parent::save();
        if ($result)
        {
            return file_put_contents(static::titleIdPath($this->id),$this->title);
        }
        else
        {
            return $result;
        }
    }
    public function feed_item()
    {
        return "<h2>".$this->title."</h2>".parent::feed_item();
    }
}