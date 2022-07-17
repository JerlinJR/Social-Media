<?php

class Mic
{
    public $brand;
    public $color;
    public $usb_port;
    public $mic_model;
    public $light;

    public function __construct($brand)
    {
        print("COnstruct");
        $this->brand = $brand;
    }

    public function setlight($light)
    {
        $this->light = $light;
    }
    public function getlight()
    {
        return $this->light;
    }
}
