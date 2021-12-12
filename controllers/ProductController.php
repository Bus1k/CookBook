<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\models\RecipeModel;

/**
 * Class ProductController
 *
 * @package app\controllers
 */
class ProductController extends Controller
{
    private object $recipes;

    public function __construct()
    {
        $this->recipes = new RecipeModel();
    }

    public function index()
    {

//        $keyword = $_GET['search'] ?? '';
//        $products = $router->database->getProducts($keyword);
//        $router->renderView('products/index', [
//            'products' => $products,
//            'keyword' => $keyword
//        ]);
    }

    public function create()
    {
        $productData = [
            'image' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);
            $product->save();
            header('Location: /products');
            exit;
        }
        $router->renderView('products/create', [
            'product' => $productData
        ]);
    }

    public function update(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }
        $productData = $router->database->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);
            $product->save();
            header('Location: /products');
            exit;
        }

        $router->renderView('products/update', [
            'product' => $productData
        ]);
    }

    public function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }

        if ($router->database->deleteProduct($id)) {
            header('Location: /products');
            exit;
        }
    }
}