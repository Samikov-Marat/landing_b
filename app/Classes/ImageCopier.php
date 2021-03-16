<?php

namespace App\Classes;

use App\Image;
use Illuminate\Support\Facades\Storage;

class ImageCopier
{
    public static function copy()
    {
        $images = Image::select('url', 'path')->get();
        $remoteBase = 'http://landing.dev.cdek.ru/storage/';
        foreach ($images as $image) {
            if (!Storage::disk('images')->exists($image->path)) {
                echo $image->url . "\n";
                if (false !== ($contents = file_get_contents($remoteBase . $image->path))) {
                    Storage::disk('images')->put($image->path, $contents);
                }
            }
        }
    }
}
