<?php

namespace App\Classes\Dvd;

use Exception;
use PDO;

class DvdRepositoryMysql implements DvdRepository
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
     * @param Dvd $dvd
     * @return Dvd
     * @throws Exception
     */
    public function addDvd(Dvd $dvd): Dvd
    {
        try {
            $sql = "INSERT INTO dvds(sku, name, price, type, size) VALUES (:sku, :name, :price, :type, :size)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':sku' => $dvd->getSku(),
                ':name' => $dvd->getName(),
                ':price' => $dvd->getPrice(),
                ':type' => $dvd->getType(),
                ':size' => $dvd->getSize()]);
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }

        return $dvd;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllDvds(): array
    {
        try {
            $stmt = $this->pdo->query('SELECT id, sku, name, price, type, size, created_at FROM dvds ORDER BY created_at DESC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dvdCollection = array_map(function ($dvd) {
                return Dvd::fromDatabase($dvd['sku'], $dvd['name'], $dvd['price'], $dvd['type'], $dvd['size'], $dvd['id'], $dvd['created_at']);
            }, $results);
            return $dvdCollection;
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }
    }

    /**
     * @param $id
     * @param $params
     * @return void
     */
    public function updateDvd($id, $params)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return void
     * @throws Exception
     */
    public function deleteDvd($id)
    {
        try {
            $sql = "DELETE FROM dvds WHERE id IN ($id)";
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
    public function getDvdByAuthor($author)
    {
        // TODO: Implement getDvdByAuthor() method.
    }
}
