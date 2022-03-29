<?php

namespace App\Classes\Book;

use Exception;
use PDO;

class BookRepositoryMysql implements BookRepository
{
    
    public PDO $pdo;

  
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Book $book
     * @return Book
     * @throws Exception
     */
    public function addBook(Book $book): Book
    {
        try {
            $sql = "INSERT INTO books(sku, name, price, type, weight) VALUES (:sku, :name, :price, :type, :weight)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                ':sku' => $book->getSku(),
                ':name' => $book->getName(),
                ':price' => $book->getPrice(),
                ':type' => $book->getType(),
                ':weight' => $book->getWeight()
            ]);
            return $book;
        } catch (Exception $e) {
            throw new Exception('Cant save to mysql repository', 0, $e);
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllBooks(): array
    {
        return ['test123'];
        try {
            $statement = $this->pdo->query('SELECT id, sku, name, price, type, weight, created_at FROM books ORDER BY created_at DESC');
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $bookCollection = array_map(function ($book) {
                return Book::fromDatabase($book['sku'], $book['name'], $book['price'], $book['type'], $book['weight'], $book['id'], $book['created_at']);
            }, $results);
            return $bookCollection;
        } catch (Exception $e) {
            throw new Exception('Cant get books from mysql repository', 0, $e);
        }
    }

    /**
     * @param $sku
     * @return bool
     */
    public function exists($sku)
    {
        $statement = $this->pdo->prepare('SELECT sku FROM books WHERE sku=:sku');
        $statement->execute([':sku' => $sku]);
        return !empty($statement->fetchAll());
    }

    /**
     * @param $id
     * @param $params
     * @return void
     */
    public function UpdateBook($id, $params)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return void
     * @throws Exception
     */
    public function deleteBook($id)
    {
        try {
            $sql = "DELETE FROM books WHERE id IN ($id)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (Exception $e) {
            throw new Exception('Cant delete book from mysql repository', 0, $e);
        }
    }

    /**
     * @param $author
     * @return void
     */
    public function getBookByAuthor($author)
    {
        // TODO: Implement getBookByAuthor() method.
    }
}
