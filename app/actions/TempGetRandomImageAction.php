<?php

namespace App\actions;

class TempGetRandomImageAction
{
    public static function img()
    {
        $imagesPath = public_path('images');
        $images = glob($imagesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        if (count($images) === 0) {
            return null;
        }
        $randomImage = $images[array_rand($images)];
        return str_replace(public_path(), '', $randomImage);
    }

    public static function gif()
    {
        $imagesPath = public_path('gifs');
        $images = glob($imagesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        if (count($images) === 0) {
            return null;
        }
        $randomImage = $images[array_rand($images)];
        return str_replace(public_path(), '', $randomImage);
    }


}
