<?php

namespace App;

abstract class Model
{
    /**
     *
     */
    use TAccessor;

    /**
     * @var \PDO object
     */
    protected $db;

    /**
     * Models associations linking
     * @var array
     */
    public $belongsTo = [];

    /**
     * @var array Model fields
     */
    protected $data = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        foreach ($this->data as $key => $value) {
            if (in_array($name, array_keys($this->belongsTo)) && !isset($this->data[$name])) {
                $this->data[$name] = $this->belongsTo[$name]['className']::findById($this->data[$this->belongsTo[$name]['foreignKey']]);
            }
        }
        return $this->data[$name];
    }


    /**
     * @return mixed
     */
    public static function findAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    /**
     * @return int
     */
    public static function countAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT COUNT(*) AS num FROM ' . static::$table;
        return (int)$db->query($sql, [], static::class)[0]->num;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function findById(int $id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $res = $db->query($sql, [':id' => $id], static::class);
        return !empty($res) ? $res[0] : false;
    }

    /**
     * @param int $quantity
     * @return mixed
     */
    public static function getLatest(int $quantity)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $quantity;
        return $db->query($sql, [], static::class);
    }

    /**
     * @return bool
     */
    public function save()
    {
        if ($this->id) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    /**
     * @return bool
     */
    protected function update()
    {
        $sets = [];
        $data = [];
        foreach ($this->data as $key => $value) {
            $data[':' . $key] = $value;
            if ('id' == $key) {
                continue;
            }
            $sets[] = $key . '=:' . $key;
        }

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $sets) . ' WHERE id=:id';
        return $this->db->execute($sql, $data);
    }

    /**
     * @return bool
     */
    protected function insert()
    {
        $keys = [];
        $data = [];
        foreach ($this->data as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $data[':' . $key] = $value;
            $keys[] = $key;
        }
        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(',', $keys) . ') VALUES (' . implode(',', array_keys($data)) . ')';
        $res = $this->db->execute($sql, $data);
        if ($res) {
            $this->id = $this->db->lastId();
        }
        return $res;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        return $this->db->execute($sql, [':id' => $this->id]);
    }
}