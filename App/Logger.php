<?php
namespace App;


class Logger
{
    use TSingleton;

    protected $fileName = __DIR__ . '/log.txt';

    protected function __construct()
    {
        if (!file_exists($this->fileName)) {
            $res = fopen($this->fileName, 'a');
            fclose($res);
        }
    }

    public function log(\Exception $e)
    {
        $obj = new \stdClass();
        $obj->date = date('d.m.y H:i:s', time());
        $obj->message = $e->getMessage();
        $obj->file = $e->getFile();
        $obj->line = $e->getLine();
        $json = json_encode($obj, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->fileName, $json . PHP_EOL, FILE_APPEND);
    }
}