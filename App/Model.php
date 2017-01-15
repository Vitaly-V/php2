<?php

namespace App;

abstract class Model
{

    public static $db;
    public $id;

    public function __construct()
    {
        static::$db = Db::getInstance();
    }

    public static function findAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    public static function countAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT COUNT(*) AS num FROM ' . static::$table;
        return (int)$db->query($sql, [], static::class)[0]->num;
    }

    public static function findById(int $id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $res = $db->query($sql, [':id' => $id], static::class);
        return !empty($res) ? $res[0] : false;
    }

    public static function getLatest(int $quantity)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $quantity;
        return $db->query($sql, [], static::class);
    }

    public function save()
    {
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    protected function update()
    {
        $sets = [];
        $data = [];
        foreach ($this as $key => $value) {
            $data[':' . $key] = $value;
            if ('id' == $key) {
                continue;
            }
            $sets[] = $key . '=:' . $key;
        }

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $sets) . ' WHERE id=:id';
        return static::$db->execute($sql, $data);
    }

    protected function insert()
    {
        $keys = [];
        $data = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $data[':' . $key] = $value;
            $keys[] = $key;
        }
        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(',', $keys) . ') VALUES (' . implode(',', array_keys($data)) . ')';
        $res = static::$db->execute($sql, $data);
        if ($res) {
            $this->id = static::$db->lastId();
        }
        return $res;
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        return static::$db->execute($sql, [':id' => $this->id]);
    }
}