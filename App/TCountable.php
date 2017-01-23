<?php

namespace App;


trait TCountable
{

    protected $data = [];

    public function count()
    {
        return count($this->data);
    }
}