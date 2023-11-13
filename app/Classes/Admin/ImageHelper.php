<?php

namespace App\Classes\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getHash()
    {
        return md5_file(Storage::disk('public')->path($this->path)) . Str::random('4');
    }
}
