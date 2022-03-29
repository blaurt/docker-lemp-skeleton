<?php

namespace App\Classes;

use Exception;

abstract class Product
{
    private string $sku;
    private string $name;
    private float $price;
    private string $type;

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @throws Exception
     */
    public function __construct(string $sku, string $name, float $price, string $type)
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void
    {
        if (strlen($sku) === 0) {
            throw new Exception("Invalid sku value.");
        }

        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        if (strlen($name) === 0) {
            throw new Exception("Invalid name value.");
        }

        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        if (strlen($price) === 0) {
            throw new Exception("Invalid price value.");
        }

        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        if (strlen($type) === 0) {
            throw new Exception("Invalid type value.");
        }

        $this->type = $type;
    }


}