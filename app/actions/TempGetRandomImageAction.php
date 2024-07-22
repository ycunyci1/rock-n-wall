<?php

namespace App\actions;

class TempGetRandomImageAction
{
    public static function run()
    {
        $imagesPath = public_path('images');
        $images = glob($imagesPath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        if (count($images) === 0) {
            return null;
        }
        $randomImage = $images[array_rand($images)];
        return str_replace(public_path(), '', $randomImage);
    }
}
