<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class OfficeUpdater
{


    public static function getInstance(): self
    {
        return new static();
    }

    public function update()
    {
        $filename = static::prepareFile();

        OfficeLoader::getInstance()->loadTo($filename);

        OfficeReader::getInstance()->read($filename);
    }

    public function prepareFile(): string
    {
        if (Storage::disk('local')->missing('offices')) {
            Storage::disk('local')->makeDirectory('offices');
        }

        return Storage::disk('local')->path('offices/geo.xml');
    }

}
