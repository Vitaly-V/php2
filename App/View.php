<?php

namespace App;


class View implements \Countable, \Iterator
{

    use TAccessor;
    use TCountable;
    use TIterator;

    public function count()
    {
        return count($this->data);
    }

    public function render($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include $template;
        $content = ob_get_clean();
        return $content;
    }

}