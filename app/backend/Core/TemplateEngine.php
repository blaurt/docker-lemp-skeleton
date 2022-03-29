<?php

namespace Core;

interface TemplateEngine
{
    public function render(string $view, array $args);
}