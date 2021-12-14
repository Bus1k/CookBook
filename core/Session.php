<?php

namespace app\core;

class Session
{
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key];
    }

    public static function remove(string $key)
    {
        unset($_SESSION[$key]);
    }
}