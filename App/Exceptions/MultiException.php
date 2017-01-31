<?php
namespace App\Exceptions;

use App\TIterator;

class MultiException extends \Exception implements \Iterator
{
    use TIterator;

    public function add(\Exception $exception)
    {
        $this->data[] = $exception;
    }

    public function isEmpty():bool
    {
        return empty($this->data);
    }
}