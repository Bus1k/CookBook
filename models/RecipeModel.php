<?php

namespace app\models;

use app\core\Model;

class RecipeModel extends Model
{
    public function rules(): array
    {
        return [
            'title'       => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 255]],
            'description' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10]],
            'ingredients' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 255]],
            'time'        => [self::RULE_REQUIRED],
            'level'       => [self::RULE_REQUIRED],
            'photo'       => [self::RULE_PHOTO, [self::RULE_FILE_MAX_SIZE, 'size_max' => 30000000]], //30 MB in bytes
        ];
    }

    public function getAll(): array
    {
        $this->db->query('SELECT * FROM RECIPES');

        return $this->db->resultSet();
    }

    public function getById(int $id): array
    {
        $this->db->query('SELECT * FROM RECIPES WHERE ID = :ID');
        $this->db->bind(':ID', $id);

        return $this->db->single();
    }

    public function getLast(): array
    {
        $this->db->query('SELECT * FROM RECIPES ORDER BY ID DESC LIMIT 1;');
        return $this->db->single();
    }

    public function create(string $title, int $user_id, ?string $image, string $description, string $ingredients, int $prep_time, string $level): int
    {
        $this->db->query('INSERT INTO RECIPES (TITLE, USER_ID, IMAGE, DESCRIPTION, INGREDIENTS, PREP_TIME, LEVEL, CREATED_AT) 
                                VALUES (:TITLE, :USER_ID, :IMAGE, :DESCRIPTION, :INGREDIENTS, :PREP_TIME, :LEVEL, :CREATED_AT)');

        $this->db->bind(':TITLE', $title);
        $this->db->bind(':USER_ID', $user_id);
        $this->db->bind(':IMAGE', $image);
        $this->db->bind(':DESCRIPTION', $description);
        $this->db->bind(':INGREDIENTS', $ingredients);
        $this->db->bind(':PREP_TIME', $prep_time);
        $this->db->bind(':LEVEL', $level);
        $this->db->bind(':CREATED_AT', $this->getDate());
        $this->db->execute();

        return $this->db->getInsertId();
    }

    public function update(int $id, string $title, ?string $image, string $description, string $ingredients, int $prep_time, string $level): void
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
        $this->db->bind(':MODIFIED_AT', $this->getDate());
        $this->db->execute();
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM RECIPES WHERE ID = :ID');
        $this->db->bind(':ID', $id);
        $this->db->execute();
    }
}