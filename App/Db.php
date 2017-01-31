<?php

namespace App;

use App\Exceptions\DbException;

class Db
{

    use TSingleton;

    protected $dbh;

    protected function __construct()
    {
        $config = Config::getInstance(__DIR__ . DS . 'Configs' . DS . 'config.php');
        $dsn = 'mysql:host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['name'] . ';charset=' . $config->data['db']['charset'];
        try {
            $this->dbh = new \PDO($dsn, $config->data['db']['user'], $config->data['db']['password']);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            throw new DbException('Database connection error: ' . $e->getMessage());
        }
    }

    public function query($sql, $data = [], $class = null)
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new DbException('Error during query preparing: ' . $e->getMessage());
        }
        try {
            $sth->execute($data);
        } catch (\PDOException $e) {
            throw new DbException('Error during query executing: ' . $e->getMessage());
        }

        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function execute($sql, $data = []): bool
    {
        try {
            $sth = $this->dbh->prepare($sql);
        } catch (\PDOException $e) {
            throw new DbException('Error during query preparing: ' . $e->getMessage());
        }
        try {
            return $sth->execute($data);
        } catch (\PDOException $e) {
            throw new DbException('Error during query executing: ' . $e->getMessage());
        }

    }

    public function lastId(): int
    {
        return $this->dbh->lastInsertId();
    }


}