<?php

namespace App\Classes\Site;

use Illuminate\Support\Facades\Http;

class CountryByCityUuid
{
    private const URL = 'https://samakr.com/api/v1/city/details/country';
    public function get(string $uuid): string
    {
        $response = Http::post(self::URL, [
            'uuid' => $uuid
        ]);
        if ($response->successful()) {
            return $response['data'];
        }
        throw new \Exception('Не удалось получить код страны');
    }
}