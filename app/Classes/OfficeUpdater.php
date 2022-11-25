<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Storage;

class OfficeUpdater
{
    private $source;
    private $filename;
    private $officeModelClass;

    public function __construct($officeModelClass)
    {
        $this->officeModelClass = $officeModelClass;
    }

    public static function getInstance($officeModelClass): self
    {
        return new static($officeModelClass);
    }

    public function setSource($source)
    {
        if (is_null($source)) {
            throw new Exception('Source должен быть не null');
        }
        $this->source = $source;
        return $this;
    }

    public function setFilename($filename)
    {
        if (is_null($filename)) {
            throw new Exception('Filename должен быть не null');
        }
        $this->filename = $filename;
        return $this;
    }

    public function update()
    {
        if(!isset($this->filename)){
            throw new Exception('Не установлен filename');
        }
        $fullFilename = static::prepareFile($this->filename);

        if(!isset($this->source)){
            throw new Exception('Не установлен source');
        }
        OfficeLoader::getInstance($this->source)->loadTo($fullFilename);

        OfficeReader::getInstance($this->officeModelClass)->read($fullFilename);
    }

    public function prepareFile($filename): string
    {
        if (Storage::disk('local')->missing('offices')) {
            Storage::disk('local')->makeDirectory('offices');
        }

        return Storage::disk('local')->path('offices/' . $filename);
    }

}
