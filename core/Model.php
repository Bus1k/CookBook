<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL    = 'email';
    public const RULE_MIN      = 'min';
    public const RULE_MAX      = 'max';
    public const RULE_MATCH    = 'match';

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
                        $this->addError($attribute , self::RULE_REQUIRED);
                    }

                    if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addError($attribute , self::RULE_EMAIL);
                    }

                    if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                        $this->addError($attribute , self::RULE_MIN, $rule);
                    }

                    if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                        $this->addError($attribute , self::RULE_MAX, $rule);
                    }

                    if($ruleName === self::RULE_MATCH && $value !== $data[$rule['match']]) {
                        $this->addError($attribute , self::RULE_MATCH, $rule);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addError(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach($params as $key => $value) {
            $message = str_replace('{'.$key.'}', $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    private function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL    => 'This field must be valid email address',
            self::RULE_MIN      => 'Min length of this field must be {min}',
            self::RULE_MAX      => 'Max length of this field must be {max}',
            self::RULE_MATCH    => 'This field must be the same as {match}'
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