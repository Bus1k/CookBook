<?php

namespace app\models;

use app\core\Database;

class RecipeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM RECIPES');

        return $this->db->resultSet();
    }
}