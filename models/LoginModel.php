<?php

namespace app\models;

use app\core\Model;

class LoginModel extends Model
{

    public function rules(): array
    {
        return [
            'email'    => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 255]],
        ];
    }
}