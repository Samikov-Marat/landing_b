<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getMimeTypeByUrl($url)
    {
        $extension = Str::lower(pathinfo($url, PATHINFO_EXTENSION));
        if ('svg' == $extension) {
            return 'image/svg+xml';
        }
        if ('css' == $extension) {
            return 'text/css';
        }
        if (in_array($extension, ['jpg', 'jpeg'])) {
            return 'image/jpeg';
        }
        if ('png' == $extension) {
            return 'image/png';
        }
        if ('pptx' == $extension) {
            return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
        }
        if ('pdf' == $extension) {
            return 'application/pdf';
        }
        return 'text/plain';
    }

}
