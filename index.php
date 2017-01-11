<?php

const DS = DIRECTORY_SEPARATOR;
require __DIR__ . DS . 'autoload.php';

$news = \App\Models\Article::getLatest(3);

include __DIR__ . DS . 'App' . DS . 'Views' . DS . 'News.php';