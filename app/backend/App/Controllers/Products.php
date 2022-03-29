<?php

namespace App\Controllers;

use App\Classes\Book\BookService;
use App\Classes\Components\Validator;
use App\Classes\Dvd\DvdService;
use App\Classes\Furniture\FurnitureService;
use Core\Controller;
use Exception;

class Products extends Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $factory = $this->serviceFactory;

        $bookService = $factory->getService(BookService::getType());
        $dvdService = $factory->getService(DvdService::getType());
        $furnitureService = $factory->getService(FurnitureService::getType());

        $booksTable = $bookService->getAllProducts();
        $dvdsTable = $dvdService->getAllProducts();
        $furnitureTable = $furnitureService->getAllProducts();
        $allProducts = [...$booksTable, ...$dvdsTable, ...$furnitureTable];
        usort($allProducts, function ($a, $b) {
            return $b->created_at <=> $a->created_at;
        });
        return $this->render('products/index.html.twig', ['allProducts' => $allProducts]);
    }

    public function addProductAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $factory = $this->serviceFactory;

                $validator = new Validator($_POST);
                $validator->isRequired("sku", "sku_is_required", "Sku can not be empty.");
                $validator->isRequired("name", "name_is_required", "Name can not be empty.");
                $validator->isRequired("price", "price_is_required", "Price can not be empty.");

                switch ($_POST['type']) {
                    case('book'):
                        $validator->isRequired("weight", "weight_is_required", "Weight can not be empty.");
                        break;
                    case('dvd'):
                        $validator->isRequired("size", "size_is_required", "Size can not be empty.");
                        break;
                    case('furniture'):
                        $validator->isRequired("height", "height_is_required", "Height can not be empty.");
                        $validator->isRequired("length", "length_is_required", "Length can not be empty.");
                        $validator->isRequired("width", "width_is_required", "Width can not be empty.");
                        break;
                    default:
                        echo "No such product type";
                }

                if ($validator->isFailed()) {
                    return $this->render('products/addproduct.html.twig', ['validator' => $validator]);
//                    $this->redirect('/products/addproduct.html.twig');
                }

                $service = $factory->getService($_POST['type']);
                $service->addProduct($_POST);
                $this->redirect('/');
            } catch (Exception $e) {
                throw new Exception("Can't add product", 0, $e);
            }
        }
        return $this->render('products/addproduct.html.twig', []);
    }

    public function deleteAction()
    {
//        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
//            $factory = new ProductServiceFactory();
//            $service = $factory->getService('book');
//            $service->deleteProduct($_POST['id']);
//        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $factory = $this->serviceFactory;
            if (!empty($_POST['book'])) {
                $book = implode(', ', $_POST['book']);
                $bookService = $factory->getService(BookService::getType());
                $bookService->deleteProduct($book);
            }

            if (!empty($_POST['dvd'])) {
                $dvd = implode(', ', $_POST['dvd']);
                $dvdService = $factory->getService(DvdService::getType());
                $dvdService->deleteProduct($dvd);
            }

            if (!empty($_POST['furniture'])) {
                $furniture = implode(', ', $_POST['furniture']);
                $furnitureService = $factory->getService(FurnitureService::getType());
                $furnitureService->deleteProduct($furniture);
            }
        }
        $this->redirect('/');
    }
}
