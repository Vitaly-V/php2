<?php

namespace App\Classes\Db;

use App\Classes\TSingleton;
use App\Classes\Config;

class Db
{

    use TSingleton;

    protected $dbh;

    protected function __construct()
    {
        $config = Config::getInstance(__DIR__ . DS . '..' . DS . '..' . DS . 'Configs' . DS .  'config.php');
        $dsn = 'mysql:host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['name'] . ';charset=' . $config->data['db']['charset'];
        $this->dbh = new \PDO($dsn, $config->data['db']['user'], $config->data['db']['password']);
    }

    public function query($sql, $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false === $res) {
            die('DB error in ' . $sql);
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function execute($sql, $data = []): bool
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    public function lastId(): int
    {
        return $this->dbh->lastInsertId();
    }


}