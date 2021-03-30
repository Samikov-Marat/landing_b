<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class ImageResponse
{
    var $disk;
    var $path;

    public function __construct()
    {
        $this->disk = Storage::disk('images');
    }

    public static function getInstance(): ImageResponse
    {
        return new static();
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->disk->path($this->path);
    }

    public function getMimeType()
    {
        $mimeType = $this->disk->mimeType($this->path);
        if ('image/svg' == $mimeType) {
            $mimeType = 'image/svg+xml';
        }
        return $mimeType;
    }
}
