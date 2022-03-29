<?php

namespace App\Classes\Furniture;

interface FurnitureRepository
{
    /**
     * @param Furniture $furniture
     * @return mixed
     */
    public function addFurniture(Furniture $furniture);

    /**
     * @return mixed
     */
    public function getAllFurniture();

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateFurniture(int $id, array $params);

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteFurniture(string $id);

    /**
     * @param string $author
     * @return mixed
     */
    public function getFurnitureByAuthor(string $author);
}