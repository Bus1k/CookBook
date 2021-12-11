<?php

namespace app\core;

/**
 * Class Router
 *
 * @package app
 */
class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $url = $_SERVER['REQUEST_URI'] ?? '/';

        if ($method === 'GET') {
            $callback = $this->getRoutes[$url] ?? null;
        } else {
            $callback = $this->postRoutes[$url] ?? null;
        }

        if (!$callback) {
            echo 'Page not found';
            exit;
        }

        if(is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        echo $callback($this);
    }
}