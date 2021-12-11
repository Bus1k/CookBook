<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use app\controllers\ProductController;
use app\Router;

if(file_exists(__DIR__.'/../vendor/autoload.php')){
    require_once __DIR__.'/../vendor/autoload.php';
} else {
    die('Run command composer install');
}

if(file_exists(__DIR__.'/../config/config.php')){
    require_once __DIR__.'/../config/config.php';
} else {
    die('Configure the settings in the config.php file');
}

$database = new \app\Database();



//$router = new Router($database);
//
//$router->get('/', [ProductController::class, 'index']);
//$router->get('/products', [ProductController::class, 'index']);
//$router->get('/products/index', [ProductController::class, 'index']);
//$router->get('/products/create', [ProductController::class, 'create']);
//$router->post('/products/create', [ProductController::class, 'create']);
//$router->get('/products/update', [ProductController::class, 'update']);
//$router->post('/products/update', [ProductController::class, 'update']);
//$router->post('/products/delete', [ProductController::class, 'delete']);
//
//$router->resolve();