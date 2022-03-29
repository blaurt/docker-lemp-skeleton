<?php

namespace App\Classes\Book;

use App\ProductService;
use Exception;

class BookService extends ProductService
{
    private BookRepository $bookRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param $params
     * @return mixed
     * @throws Exception
     */
    public function addProduct($params): mixed
    {
        $newBook = new Book($params['sku'], $params['name'], $params['price'], $params['type'], $params['weight']);
        $savedBook = $this->bookRepository->AddBook($newBook);
        return $savedBook;
    }

    /**
     * @return mixed
     */
    public function getAllProducts()
    {   
        return [];
        $books = $this->bookRepository->getAllBooks();
        return $books;
    }

    /**
     * @param $bookId
     * @param $params
     * @return void
     */
    public function updateProduct($bookId, $params)
    {
        $this->bookRepository->updateBook($bookId, $params);
    }

    /**
     * @param $bookId
     * @return void
     */
    public function deleteProduct($bookId)
    {
        $this->bookRepository->deleteBook($bookId);
    }
}