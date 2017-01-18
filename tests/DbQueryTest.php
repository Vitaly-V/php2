<?php

require __DIR__ . '/../autoload.php';

class DbQueryTest
{

    public function testInsert(array $testData): string
    {
        $db = new \App\Classes\Db\Db();
        $sql = 'INSERT INTO news(title, text) VALUES (:title, :text)';
        if ($db->execute($sql, $testData)) {
            $msg = 'Success. Row added';
        } else {
            $msg = 'Error. Sql request was: ' . $sql;
        }
        return $msg;
    }


    public function testUpdate(array $testData): string
    {
        $db = new \App\Classes\Db\Db();
        $sql = 'UPDATE news SET title = :title, text = :text WHERE id = :id';
        if ($db->execute($sql, $testData)) {
            $msg = 'Success. Row updated';
        } else {
            $msg = 'Error. Sql request was: ' . $sql;
        }
        return $msg;
    }
}


$testDbQuery = new DbQueryTest();
echo $testDbQuery->testInsert([':title' => 'Test title 1', ':text' => 'Test text 1']);
echo $testDbQuery->testUpdate([':title' => 'Test title updated', ':text' => 'Test text updated', ':id' => 1]);