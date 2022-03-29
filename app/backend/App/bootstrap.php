<?php

use App\Classes\Book\BookRepositoryMysql;
use App\Classes\Dvd\DvdRepositoryMysql;
use App\Classes\Furniture\FurnitureRepositoryMysql;
use App\Config;
use App\ProductServiceFactory;
use Core\TwigTemplateEngine;

/**
 * Composer
 */
require '../vendor/autoload.php';

/**
 * Twig
 */
$loader = new Twig_Loader_Filesystem('../App/templates');
$twig = new Twig_Environment($loader);
$templateEngine = new TwigTemplateEngine($twig);

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Session start
 */
session_start();

/**
 * Database connection
 */
$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
$pdo = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
// Throw an Exception when an error occurs
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/**
 * Service setup
 */
// $bookRepository = new BookRepositoryMysql($pdo);
// $dvdRepository = new DvdRepositoryMysql($pdo);
// $furnitureRepository = new FurnitureRepositoryMysql($pdo);
$container = new DI\Container();
$builder = new DI\ContainerBuilder();

$builder->addDefinitions([
    PDO::class => function () use ($pdo) {
        return $pdo;
    },
]);

$container = $builder->build();

$bookRepository = $container->get(BookRepositoryMysql::class);
var_dump($bookRepository->getAllBooks());

die();

$serviceFactory = new ProductServiceFactory($bookRepository, $dvdRepository, $furnitureRepository);

/**
 * Routing
 */
$router = new Core\Router($serviceFactory,$templateEngine);

// Add the routes
$router->add('', ['controller' => 'products', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
//$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->dispatch($_SERVER['QUERY_STRING']);
//
//$container = new DI\Container();
//$b = $container->get('App\Classes\B');
//$b->register('example@example.com', '123456');