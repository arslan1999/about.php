<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 10.08.2016
 * Time: 3:18
 */
class Image extends Note  implements feedable
{
    public $image;
    public $discription;
    public static $fields = ["format", "size", "date"];
    protected $data = [];

    public static function storeFolder()
    {
        return 'image';
    }

    public static function contentIdPath($id)
    {
        return static::storeFolder().'/'.$id.'.jpg';
    }

    public static function titleIdPath($id)
    {
        return static::storeFolder().'/discription'.$id.'.txt';
    }

    public function __construct($id = null)
    {

        foreach (static::$fields as $value){
            $this->data[$value] = NULL;
        }

        parent::__construct($id);
    }

    protected function load()
    {
        $image = file_get_contents(static::contentIdPath($this->id));
        $this->image = $image;
        $discription = file_get_contents(static::titleIdPath($this->id));
        $this->discription = $discription;
    }

    public function saveDiscription()
    {
        return file_put_contents(static::titleIdPath($this->id),$this->discription);
    }

    public function save()
    {
        if ($this->id === NULL)
        {
            $id = static::getFreeId();
            $this->id = $id;
        }
        return static::contentIdPath($this->id);
    }

    public function __get($field)
    {
        if (in_array($field, array_keys($this->data))){
            return $this->data[$field];
        }
        else{
            die("Поля {$field} не найдено");
        }
    }

    public function add_to_feed()
    {
        parent::add_to_feed();
    }
    public function feed_item()
    {
        return '<div class="panel-heading"><h3 class="panel-title">'.$this->discription.'</h3></div><div class="panel-body"><img width="300" src="'.static::contentIdPath($this->id).'"></div>';
    }

}