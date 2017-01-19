<?php

namespace App\Models;

use App\Db;
use App\Model;

class Author extends Model
{
    /**
     * @var string Table name
     */
    public static $table = 'authors';

    /**
     * Search author by full name
     * @param string $fullName
     * @return bool
     */
    public static function findByFullName(string $fullName)
    {
        $db = Db::getInstance();
        $data = explode(' ', trim($fullName));
        $author[':firstname'] = trim($data[0]);
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE firstname = :firstname';
        if (!empty($data[1])) {
            $author[':lastname'] = trim($data[1]);
            $sql .= ' AND lastname = :lastname';
        }
        $res = $db->query($sql, $author, static::class);
        return !empty($res) ? $res[0] : false;
    }


}