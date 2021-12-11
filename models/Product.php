<?php

namespace app\models;

use app\core\Database;
use app\helpers\UtilHelper;

/**
 * Class Product
 *
 * @package app\models
 */
class Product
{
    public ?int $id = null;
    public string $title;
    public string $description;
    public float $price;
    public array $imageFile;
    public ?string $imagePath = null;

    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->imageFile = $data['imageFile'];
        $this->imagePath = $data['image'] ?? null;
    }

    public function save()
    {
        $errors = [];
        if (!is_dir(__DIR__ . '/../public/images')) {
            mkdir(__DIR__ . '/../public/images');
        }

        if (!$this->title) {
            $errors[] = 'Product title is required';
        }

        if (!$this->price) {
            $errors[] = 'Product price is required';
        }

        if (empty($errors)) {
            if ($this->imageFile && $this->imageFile['tmp_name']) {
                if ($this->imagePath) {
                    unlink(__DIR__ . '/../public/' . $this->imagePath);
                }
                $this->imagePath = 'images/' . UtilHelper::randomString(8) . '/' . $this->imageFile['name'];
                mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));
                move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../public/' . $this->imagePath);
            }

            $db = Database::$db;
            if ($this->id) {
                $db->updateProduct($this);
            } else {
                $db->createProduct($this);
            }

        }
    }

    public function getProducts($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM products WHERE title like :keyword ORDER BY create_date DESC');
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updateProduct(Product $product)
    {
        $statement = $this->pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price WHERE id = :id");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);

        $statement->execute();
    }

    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
    }
}