<?php

namespace App\Classes\Furniture;

use Exception;
use PDO;

class FurnitureRepositoryMysql implements FurnitureRepository
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    /**
     * @param Furniture $furniture
     * @return Furniture
     * @throws Exception
     */
    public function addFurniture(Furniture $furniture): Furniture
    {
        try {
            $sql = "INSERT INTO furniture(sku, name, price, type, height, length, width) VALUES (:sku, :name, :price, :type, :height, :length, :width)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':sku' => $furniture->getSku(),
                ':name' => $furniture->getName(),
                ':price' => $furniture->getPrice(),
                ':type' => $furniture->getType(),
                ':height' => $furniture->getHeight(),
                ':length' => $furniture->getLength(),
                ':width' => $furniture->getWidth()
            ]);
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }
        return $furniture;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllFurniture(): array
    {
        try {
            $stmt = $this->pdo->query('SELECT id, sku, name, price, type,  height, length, width, created_at FROM furniture ORDER BY created_at DESC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($results);
            $furnitureCollection = array_map(function ($furniture) {
                return Furniture::fromDatabase($furniture['sku'], $furniture['name'], $furniture['price'], $furniture['type'], $furniture['height'], $furniture['length'], $furniture['width'], $furniture['id'], $furniture['created_at']);
            }, $results);
            return $furnitureCollection;
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }
    }

    /**
     * @param $id
     * @param $params
     * @return void
     */
    public function updateFurniture($id, $params)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return void
     * @throws Exception
     */
    public function deleteFurniture($id)
    {
        try {
            $sql = "DELETE FROM furniture WHERE id IN ($id)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }
    }

    /**
     * @param $author
     * @return void
     */
    public function getFurnitureByAuthor($author)
    {
        // TODO: Implement getFurnitureByAuthor() method.
    }
}
