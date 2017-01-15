<?php

namespace App\Models;

class Fruit implements CanOrderInterface, HasVolume
{

    use VolumeTrait;

    public function getPrice(): float
    {
        return 42;
    }

    public function getWeight(): float
    {
        return 0.100;
    }
}