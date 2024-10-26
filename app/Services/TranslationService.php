<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    public static function translate($text)
    {
        $translator = new GoogleTranslate('en', 'ru');
        return $translator->translate($text);
    }
}
