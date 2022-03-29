<?php

namespace App;

use App\Classes\Book\BookRepository;
use App\Classes\Book\BookService;
use App\Classes\Dvd\DvdRepository;
use App\Classes\Dvd\DvdService;
use App\Classes\Furniture\FurnitureRepository;
use App\Classes\Furniture\FurnitureService;
use Exception;

class ProductServiceFactory
{
    private BookRepository $bookRepository;
    private DvdRepository $dvdRepository;
    private FurnitureRepository $furnitureRepository;

    /**
     * @param BookRepository $bookRepository
     * @param DvdRepository $dvdRepository
     * @param FurnitureRepository $furnitureRepository
     */
    public function __construct(BookRepository $bookRepository, DvdRepository $dvdRepository, FurnitureRepository $furnitureRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->dvdRepository = $dvdRepository;
        $this->furnitureRepository = $furnitureRepository;
    }

    /**
     * @param string $type
     * @return BookService|DvdService|FurnitureService
     * @throws Exception
     */
    public function getService(string $type)
    {
        switch ($type) {
            case BookService::getType():
                $mysqlService = $this->bookRepository;
                return new BookService($mysqlService);
            case DvdService::getType():
                $mysqlService = $this->dvdRepository;
                return new DvdService($mysqlService);
            case FurnitureService::getType():
                $mysqlService = $this->furnitureRepository;
                return new FurnitureService($mysqlService);
            default:
                throw new Exception('No such product type.');
        }
    }
}

