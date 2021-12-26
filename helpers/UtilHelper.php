<?php

namespace app\helpers;


/**
 * Class UtilHelper
 *
 * @package app\helpers
 */
class UtilHelper
{
    public static function randomString($n): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }

    public static function saveFile(array $file, string $fileLocation): string
    {
        $extension = pathinfo($file['full_path'], PATHINFO_EXTENSION);
        $filePath  = $fileLocation . self::randomString(15) . '.' .$extension;

        move_uploaded_file($file['tmp_name'], $filePath);

        return pathinfo($filePath)['basename'];
    }
}