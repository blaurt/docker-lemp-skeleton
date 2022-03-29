<?php

namespace App\Classes\Book;

interface BookRepository
{
    /**
     * @param Book $book
     * @return mixed
     */
    public function addBook(Book $book);

    /**
     * @return mixed
     */
    public function getAllBooks();

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateBook(int $id, array $params);

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteBook(string $id);

    /**
     * @param string $author
     * @return mixed
     */
    public function getBookByAuthor(string $author);
}