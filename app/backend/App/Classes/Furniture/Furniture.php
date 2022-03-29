<?php

namespace App\Classes\Furniture;

use App\Classes\Product;
use Exception;

class Furniture extends Product
{
    /**
     * @var float
     */
    private float $height;
    /**
     * @var float
     */
    private float $length;
    /**
     * @var float
     */
    private float $width;

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $height
     * @param float $length
     * @param float $width
     * @throws Exception
     */
    public function __construct(string $sku, string $name, float $price, string $type, float $height, float $length, float $width)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->setHeight($height);
        $this->setLength($length);
        $this->setWidth($width);
    }

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $height
     * @param float $length
     * @param float $width
     * @param int $id
     * @param string $created_at
     * @return Furniture
     * @throws Exception
     */
    public static function
    fromDatabase(string $sku, string $name, float $price, string $type, float $height, float $length, float $width, int $id, string $created_at): Furniture
    {
        $furniture = new self($sku, $name, $price, $type, $height, $length, $width);
        $furniture->id = $id;
        $furniture->created_at = $created_at;
        return $furniture;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength(float $length): void
    {
        $this->length = $length;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @throws Exception
     */
    public function setWidth(float $width): void
    {
        if (strlen($width) === 0) {
            throw new Exception("Invalid width value.");
        }
        $this->width = $width;
    }
}