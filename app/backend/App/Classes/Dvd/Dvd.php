<?php

namespace App\Classes\Dvd;

use App\Classes\Product;
use Exception;

class Dvd extends Product
{
    private float $size;

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $size
     * @throws Exception
     */
    public function __construct(string $sku, string $name, float $price, string $type, float $size)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->setSize($size);
    }

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $size
     * @param int $id
     * @param string $created_at
     * @return Dvd
     * @throws Exception
     */
    public static function fromDatabase(string $sku, string $name, float $price, string $type, float $size, int $id, string $created_at): Dvd
    {
        $dvd = new self($sku, $name, $price, $type, $size);
        $dvd->id = $id;
        $dvd->created_at = $created_at;
        return $dvd;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @param float $size
     * @throws Exception
     */
    public function setSize(float $size): void
    {
        if (strlen($size) === 0) {
            throw new Exception("Invalid size value.");
        }

        $this->size = $size;
    }
}