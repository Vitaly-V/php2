<?php

namespace App;


trait TCountable
{
    public function count()
    {
        return count($this->data);
    }
}