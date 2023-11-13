<?php

namespace App\Classes;

use App\Site;
use Illuminate\Database\Eloquent\Collection;

class UploadedCss
{
    public static function getAll(Site $site, string $landURI): Collection
    {
        return $site->images()
            ->whereIn('url', ['/theme.css', '/' . $landURI . '.css'])
            ->get()
            ->keyBy('url');
    }
}
