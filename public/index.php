<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

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

use app\controllers\RecipeController;
use app\controllers\RegisterController;
use app\core\Router;


$database = new \app\core\Database();
$router   = new Router();

$router->get('/', [RecipeController::class, 'index']);
$router->get('/products', [ProductController::class, 'index']);
//$router->get('/products/index', [ProductController::class, 'index']);
//$router->get('/products/create', [ProductController::class, 'create']);
//$router->post('/products/create', [ProductController::class, 'create']);
//$router->get('/products/update', [ProductController::class, 'update']);
//$router->post('/products/update', [ProductController::class, 'update']);
//$router->post('/products/delete', [ProductController::class, 'delete']);
//

$router->get('/register', [RegisterController::class, 'create']);
$router->post('/register', [RegisterController::class, 'store']);

$router->get('/login', [RegisterController::class, 'login']);


$router->resolve();