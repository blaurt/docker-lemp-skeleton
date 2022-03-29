<?php

namespace Core;

class TwigTemplateEngine implements TemplateEngine
{
    private $twig;

    /**
     * @param $twig
     */
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public function render($template, $args = [])
    {
        echo $this->twig->render($template, $args);
    }
}
