<?php

namespace App\Classes\Site;

use Illuminate\Support\Str;

class CalculatorLanguage
{
    const DEFAULT = 'eng';
    const OLD_LANGUAGES = ['eng', 'rus', 'zho', 'tur'];

    public static function getLanguage(string $requestLanguage):string
    {
        $language = Str::lower($requestLanguage);
        if (in_array($language, static::OLD_LANGUAGES)) {
            return $language;
        }
        return static::DEFAULT;
    }
}
