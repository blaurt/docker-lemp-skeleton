<?php

namespace Core;

use Exception;

class View implements TemplateEngine
{
    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws Exception
     */
    public function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/templates/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }
}
