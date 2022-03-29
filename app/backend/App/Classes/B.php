<?php

namespace App\Classes;

class B
{
    private $a;

    public function __construct(A $a)
    {
        $this->a = $a;
    }

    public function register($email, $password)
    {
        $this->a->mail($email, 'Hello you are registered');
    }

}