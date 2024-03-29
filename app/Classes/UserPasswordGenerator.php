<?php

namespace App\Classes;

use Exception;

class UserPasswordGenerator
{
    const UNDERSTANDABLE_SYMBOLS = 'AabCcDdEeFfHhiJjKkLMmNnoPpRrSsTtUuVvXxYyZz2345679';
    const PASSWORD_LENGTH = 12;

    public static function getPassword(): string
    {
        $symbolsCount = strlen(self::UNDERSTANDABLE_SYMBOLS);
        if (!$symbolsCount) {
            throw new Exception('Нет словаря символов');
        }
        $password = '';
        for ($i = 0; $i < self::PASSWORD_LENGTH; $i++) {
            $password .= self::UNDERSTANDABLE_SYMBOLS[rand(0, $symbolsCount - 1)];
        }
        return $password;
    }
}
