<?php

namespace App;

use App\Classes\TAccessor;

class View implements \Countable
{

    use TAccessor;

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
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}