<?php

namespace app\core;

class Controller
{
    protected function view(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include PATH_ROOT.'/views/'. $view .'.php';
        $content = ob_get_clean();
        include PATH_ROOT."/views/_layout.php";
    }

    protected function redirect(string $page)
    {
        header('Location: '.$page);
        exit;
    }

}