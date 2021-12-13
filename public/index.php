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
use app\controllers\AuthController;
use app\core\Router;


$database = new \app\core\Database();
$router   = new Router();

$router->get('/', [RecipeController::class, 'index']);
$router->get('/register', [AuthController::class, 'create']);
$router->post('/register', [AuthController::class, 'store']);
$router->get('/login', [AuthController::class, 'login']);

$router->resolve();