<?php

namespace App\Models;

use App\Classes\Db\Model;

class Article extends Model
{

    public static $table = 'news';

    protected $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        if ($name == 'author') {
            if (isset($this->author_id)) {
                $this->data['author'] = Author::findById($this->author_id);
            }
        }

    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

}