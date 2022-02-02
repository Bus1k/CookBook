<?php

namespace app\helpers;


/**
 * Class UtilHelper
 *
 * @package app\helpers
 */
class UtilHelper
{
    public static function randomString(int $n = 10): string
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

    public static function checkPhotos(array &$recipes): void
    {
        foreach($recipes as $key => $recipe) {
            if(empty($recipe['IMAGE']) || !file_exists(PATH_FILES.$recipe['IMAGE'])) {
                $recipes[$key]['IMAGE'] = '../images/no-img.jpg';
            }
        }
    }

    public static function cutString(string $str, int $length = 200, bool $ellipsis = false): string
    {
        if (strlen($str) > $length)
        {
            $str = substr($str, 0, $length);
            $str = explode(' ', $str);
            array_pop($str); // remove last word from array
            $str[count($str) - 1] = str_replace([',', '.', ':', ';', '<', '>'], '', $str[count($str) - 1]);
            $str = implode(' ', $str);
        }

        if($ellipsis) {
            return $str . '...';
        }

        return $str;
    }
}