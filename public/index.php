<?php
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
use app\controllers\LoginController;
use app\core\Router;

\app\core\Session::start();

$database = new \app\core\Database();
$router   = new Router();

/*
 *
 * BASIC ROUTING
 *
 */
//HOMEPAGE
$router->get('/', [RecipeController::class, 'index']);
$router->post('/', [RecipeController::class, 'index']);

//REGISTER USER
$router->get('/register', [RegisterController::class, 'create']);
$router->post('/register', [RegisterController::class, 'store']);

//LOGIN AND LOGOUT
$router->get('/login', [LoginController::class, 'create']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//RECIPES
$router->get('/recipe/add', [RecipeController::class, 'create']);
$router->post('/recipe/add', [RecipeController::class, 'store']);
$router->get('/recipe/show', [RecipeController::class, 'show']);
$router->get('/recipe/edit', [RecipeController::class, 'edit']);
$router->post('/recipe/edit', [RecipeController::class, 'update']);
$router->get('/recipe/delete', [RecipeController::class, 'destroy']);

$router->resolve();