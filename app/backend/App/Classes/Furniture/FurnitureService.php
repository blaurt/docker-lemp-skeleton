<?php

namespace App\Classes\Furniture;

use App\ProductService;

class FurnitureService extends ProductService
{
    private FurnitureRepository $furnitureRepository;

    public function __construct(FurnitureRepository $furnitureRepository)
    {
        $this->furnitureRepository = $furnitureRepository;
    }

    public function addProduct($params)
    {
        $newFurniture = new Furniture($params['sku'], $params['name'], $params['price'], $params['type'], $params['height'], $params['length'], $params['width']);
        $savedFurniture = $this->furnitureRepository->addFurniture($newFurniture);
        return $savedFurniture;
    }

    public function getAllProducts()
    {
        return [];
        $furniture = $this->furnitureRepository->getAllFurniture();
        return $furniture;
    }

    public function UpdateProduct($FurnitureId, $params)
    {
        $this->furnitureRepository->updateFurniture($FurnitureId, $params);
    }

    public function deleteProduct($furnitureId)
    {
        $this->furnitureRepository->deleteFurniture($furnitureId);
    }

}