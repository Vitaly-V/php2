<?php

namespace App;

use App\Models\CanOrderInterface;

class Ordering
{
    public function order(CanOrderInterface $item)
    {
        echo 'Order ';
        echo 'Price: ' . $item->getPrice();
    }
}