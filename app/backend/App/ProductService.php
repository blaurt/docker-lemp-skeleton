<?php

namespace App;

abstract class ProductService
{
    /**
     * @return string
     */
    static public function getType()
    {
        $class = explode('\\',static::class);
        $class = explode('Service', end($class));
        return strtolower($class[0]);
    }

    /**
     * @param $params
     * @return mixed
     */
    abstract function addProduct($params);

    /**
     * @return mixed
     */
    abstract function getAllProducts();

    /**
     * @param $params
     * @return mixed
     */
    abstract function deleteProduct($params);
}