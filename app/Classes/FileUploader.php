<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Exception;

class FileUploader
{
    var $modelInstance;
    var $field;

    var $request;
    var $requestField;

    var $disk;


    public function __construct(Model $modelInstance, string $field)
    {
        $this->modelInstance = $modelInstance;
        $this->field = $field;
    }

    public static function to(Model $modelInstance, string $field): self
    {
        return new static($modelInstance, $field);
    }

    public function from(Request $request, string $requestField): self
    {
        $this->request = $request;
        $this->requestField = $requestField;
        return $this;
    }

    public function setDisk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }

    public function store()
    {
        if ($this->request->hasFile($this->requestField)) {
            $path = $this->getPath();
            $this->request->file($this->requestField)
                ->storeAs(dirname($path), basename($path), ['disk' => $this->disk]);
            $this->modelInstance->setAttribute($this->field, $path);
        }
    }

    public function getPath()
    {
        $filenameByRequestField = [
            'preview' =>
                'preview/' . $this->modelInstance->id . '.' . $this->request->file($this->requestField)->extension(),
            'image' =>
                'image/' . $this->modelInstance->id . '.' . $this->request->file($this->requestField)->extension(),
            'image2' =>
                'image2/' . $this->modelInstance->id . '.' . $this->request->file($this->requestField)->extension(),
            'photo' =>
                $this->modelInstance->id . '.' . $this->request->file($this->requestField)->extension(),
            'sample' =>  $this->modelInstance->id .'/sample.' . $this->request->file($this->requestField)->extension(),
            'sample2' =>  $this->modelInstance->id .'/sample2.' . $this->request->file($this->requestField)->extension(),
            'mobile' =>  $this->modelInstance->id .'/mobile.' . $this->request->file($this->requestField)->extension(),
            'mobile2' =>  $this->modelInstance->id .'/mobile2.' . $this->request->file($this->requestField)->extension(),
            'tablet' =>  $this->modelInstance->id .'/tablet.' . $this->request->file($this->requestField)->extension(),
            'tablet2' =>  $this->modelInstance->id .'/tablet2.' . $this->request->file($this->requestField)->extension(),
        ];
        if (!Arr::exists($filenameByRequestField, $this->requestField)) {
            throw new Exception('Не удалось найти путь для сохранения файла');
        }
        return $filenameByRequestField[$this->requestField];
    }

}
