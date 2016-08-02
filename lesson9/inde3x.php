<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 26.07.2016
 * Time: 16:55
 */

class Car
{
    public $model;
    public $vendor;
    private $speed;

    public function __construct($model,$vendor,$speed = 0)
    {
        $this->model = $model;
        $this->vendor = $vendor;
        $this->speed = $speed;
    }

    // начало движения автомобиля
    public function start()
    {
        if ((int) $this->speed === 0)
        {
            $this->speed = 10;
        }
    }

    public function slowDown()
    {
        $this->speed = $this->speed - 10;
        if ($this->speed < 0) $this->speed = 0;
    }

    public function getSpeed()
    {
        return $this->speed;
    }


}

$lada = new Car("X-Ray","Lada",25);
echo "Скорость: ".$lada->getSpeed();
echo "<br/>";
$lada->start();
echo "Скорость: ".$lada->getSpeed();
