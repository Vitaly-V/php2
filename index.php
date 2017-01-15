<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$ordering = new \App\Ordering();
$ordering->order(new \App\Models\Fruit());
