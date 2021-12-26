<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED      = 'required';
    public const RULE_EMAIL         = 'email';
    public const RULE_MIN           = 'min';
    public const RULE_MAX           = 'max';
    public const RULE_MATCH         = 'match';
    public const RULE_PHOTO         = 'photo';
    public const RULE_FILE_MAX_SIZE = 'file_max_size';

    public const PHOTO_TYPES = [
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG,
    ];

    public array $errors = [];

    public Database $db;

    abstract public function rules(): array;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function getDate()
    {
        return date('Y-m-d H:i:s');
    }

    public function validate(array $data)
    {
        foreach($this->rules() as $attribute => $rules) {
            if(isset($data[$attribute])) {
                $value = $data[$attribute];

                foreach($rules as $rule) {
                    $ruleName = $rule;
                    if(!is_string($ruleName)) {
                        $ruleName = $rule[0];
                    }

                    if($ruleName === self::RULE_REQUIRED && !$value) {
                        $this->addValidationError($attribute , self::RULE_REQUIRED);
                    }

                    if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addValidationError($attribute , self::RULE_EMAIL);
                    }

                    if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                        $this->addValidationError($attribute , self::RULE_MIN, $rule);
                    }

                    if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                        $this->addValidationError($attribute , self::RULE_MAX, $rule);
                    }

                    if($ruleName === self::RULE_MATCH && $value !== $data[$rule['match']]) {
                        $this->addValidationError($attribute , self::RULE_MATCH, $rule);
                    }

                    if($ruleName === self::RULE_PHOTO && !in_array(exif_imagetype($value['tmp_name']), self::PHOTO_TYPES, true)) {
                        $this->addValidationError($attribute , self::RULE_PHOTO);
                    }

                    if($ruleName === self::RULE_FILE_MAX_SIZE && $value['size'] > $rule['size_max']) {
                        $this->addValidationError($attribute , self::RULE_FILE_MAX_SIZE);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addValidationError(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach($params as $key => $value) {
            $message = str_replace('{'.$key.'}', $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function addCustomError(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = $message;
    }

    private function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED      => 'This field is required',
            self::RULE_EMAIL         => 'This field must be valid email address',
            self::RULE_MIN           => 'Min length of this field must be {min}',
            self::RULE_MAX           => 'Max length of this field must be {max}',
            self::RULE_MATCH         => 'This field must be the same as {match}',
            self::RULE_PHOTO         => 'The image must be a file of type: jpg, jpeg, png',
            self::RULE_FILE_MAX_SIZE => 'Maximum file size 30 MB'
        ];
    }

    public function hasErrors(string $attribute): bool
    {
        return isset($this->errors[$attribute]);
    }

    public function getFirstError(string $attribute): string
    {
        return $this->errors[$attribute][0] ?? '';
    }
}