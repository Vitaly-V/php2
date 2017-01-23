<?php

namespace App\Models;

use App\Model;

class Article extends Model
{

    /**
     * @var string Table name
     */
    public static $table = 'news';

    /**
     * Models associations linking
     * @var array
     *
     */
    public $belongsTo = [
        'author' => [
            'className' => Author::class,
            'foreignKey' => 'author_id'
        ]
    ];
}