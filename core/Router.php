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

    public function get(string $url, array $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post(string $url, array $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $url = $this->removeParams($url);

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

        $callback();
    }

    //if we want pass variable in url e.g /recipe/show?id=2 we need remove ?id=2 to assign route in array /recipe/show
    public function removeParams($url)
    {
        if($url !== '')
        {
            $parts = explode('?', $url, 2);

            if(strpos($parts[0], '=') === false)
            {
                return $parts[0];
            }

            return '';
        }
    }
}