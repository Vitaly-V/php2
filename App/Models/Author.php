<?php

namespace App\Models;

use App\Classes\Db\Model;

class Author extends Model
{

    public static $table = 'authors';


    public static function findByFullName(string $fullName)
    {
        $db = Db::getInstance();
        $data = explode(' ', trim($fullName));
        $author[':firstname'] = $data[0];
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE firstname = :first_name';
        if(!empty($date[1])) {
            $author[':lastname'] = $data[1];
            $sql .= ' AND lastname = :lastname';
        }
        $res = $db->query($sql, $author, static::class);
        return !empty($res) ? $res[0] : false;
    }

}