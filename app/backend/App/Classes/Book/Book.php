<?php

namespace App\Classes\Book;

use App\Classes\Product;
use Exception;

class Book extends Product
{
    private float $weight;

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $weight
     * @throws Exception
     */
    public function __construct(string $sku, string $name, float $price, string $type, float $weight)
    {
        parent::__construct($sku, $name, $price, $type);
        $this->setWeight($weight);
    }

    /**
     * @param string $sku
     * @param string $name
     * @param float $price
     * @param string $type
     * @param float $weight
     * @param int $id
     * @param string $created_at
     * @return Book
     * @throws Exception
     */
    public static function fromDatabase(string $sku, string $name, float $price, string $type, float $weight, int $id, string $created_at): Book
    {
        $book = new self($sku, $name, $price, $type, $weight);
        $book->id = $id;
        $book->created_at = $created_at;
        return $book;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @throws Exception
     */
    public function setWeight(float $weight): void
    {
        if (strlen($weight) === 0) {
            throw new Exception("Invalid weight value.");
        }

        $this->weight = $weight;
    }
}