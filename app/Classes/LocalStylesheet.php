<?php

namespace App\Classes;

use App\Site;

class LocalStylesheet
{
    public static function hasLocalStylesheet (Site $site, string $landURI): bool
    {
        return $site->images()
            ->where('url', '/' . $landURI . '.css')
            ->exists();
    }
}
