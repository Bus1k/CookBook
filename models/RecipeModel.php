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

    public function getById(int $id)
    {
        $this->db->query('SELECT * FROM RECIPES WHERE ID = :ID');
        $this->db->bind(':ID', $id);

        return $this->db->single();
    }

    public function create(string $title, ?string $image, string $description, string $ingredients, int $prep_time, string $level, string $date)
    {
        $this->db->query('INSERT INTO RECIPES (TITLE, IMAGE, DESCRIPTION, INGREDIENTS, PREP_TIME, LEVEL, CREATED_AT) 
                                VALUES (:TITLE, :IMAGE, :DESCRIPTION, :INGREDIENTS, :PREP_TIME, :LEVEL, :CREATED_AT)');

        $this->db->bind(':TITLE', $title);
        $this->db->bind(':IMAGE', $image);
        $this->db->bind(':DESCRIPTION', $description);
        $this->db->bind(':INGREDIENTS', $ingredients);
        $this->db->bind(':PREP_TIME', $prep_time);
        $this->db->bind(':LEVEL', $level);
        $this->db->bind(':CREATED_AT', date('Y-m-d H:i:s', strtotime($date)));
        $this->db->execute();
    }

    public function update(int $id, string $title, ?string $image, string $description, string $ingredients, int $prep_time, string $level)
    {
        $this->db->query('UPDATE RECIPES SET TITLE = :TITLE, IMAGE = :IMAGE, DESCRIPTION = :DESCRIPTION, 
                                                 INGREDIENTS = :INGREDIENTS, PREP_TIME = :PREP_TIME, 
                                                 LEVEL = :LEVEL, MODIFIED_AT = :MODIFIED_AT
                                        WHERE ID = :ID');

        $this->db->bind(':ID', $id);
        $this->db->bind(':TITLE', $title);
        $this->db->bind(':IMAGE', $image);
        $this->db->bind(':DESCRIPTION', $description);
        $this->db->bind(':INGREDIENTS', $ingredients);
        $this->db->bind(':PREP_TIME', $prep_time);
        $this->db->bind(':LEVEL', $level);
        $this->db->bind(':MODIFIED_AT', date('Y-m-d H:i:s'));
    }

    public function delete(int $id)
    {
        $this->db->query('DELETE FROM RECIPES WHERE ID = :ID');
        $this->db->bind(':ID', $id);
        $this->db->execute();
    }
}