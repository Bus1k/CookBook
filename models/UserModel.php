<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public function rules(): array
    {
        return [
            'nickname'         => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 255]],
            'email'            => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'         => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 255]],
            'password_confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function create(string $nickname, string $email, string $password): void
    {
        $this->db->query('INSERT INTO USERS (NICKNAME, EMAIL, PASSWORD, CREATED_AT) 
                                VALUES (:NICKNAME, :EMAIL, :PASSWORD, :CREATED_AT)');

        $this->db->bind(':NICKNAME', $nickname);
        $this->db->bind(':EMAIL', $email);
        $this->db->bind(':PASSWORD', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind(':CREATED_AT', $this->getDate());
        $this->db->execute();
    }

    public function getByEmail(string $email)
    {
        $this->db->query('SELECT * FROM USERS WHERE EMAIL = :EMAIL');
        $this->db->bind(':EMAIL', $email);

        return $this->db->single();
    }


}