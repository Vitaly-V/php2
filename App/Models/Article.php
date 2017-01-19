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
     * @var array Model fields
     */
    protected $data = [];

    /**
     * @param $name string
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == 'author') {
            if (isset($this->author_id)) {
                $this->data['author'] = Author::findById($this->author_id);
            }
        }
        return $this->data[$name];
    }
}