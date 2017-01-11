<?php

namespace App\Models;

use App, App\Model;

class Article extends Model
{

    public static $table = 'news';

    public $title;
    public $text;

    public static function getLatest(int $quantity = 3)
    {
        $db = new App\Db();
        $sql = 'SELECT * FROM ' . self::$table . ' ORDER BY id DESC LIMIT ' . $quantity;
        return $db->query($sql, [], self::class);
    }

}