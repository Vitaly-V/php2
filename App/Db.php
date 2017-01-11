<?php

namespace App;

class Db
{

    protected $dbh;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=php2;charset=UTF8';
        $user = 'dbuser';
        $password = '123';
        $this->dbh = new \PDO($dsn, $user, $password);
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

}