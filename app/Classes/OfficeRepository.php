<?php

namespace App\Classes;

use Exception;

class OfficeRepository
{
    var $buffer = [];
    var $bufferSize;
    var $officeModelClass;

    function __construct($officeModelClass, $bufferSize = 100)
    {
        $this->bufferSize = $bufferSize;
        $this->officeModelClass = $officeModelClass;
    }

    function __destruct()
    {
        $this->flush();
    }

    public function clear()
    {
        $this->officeModelClass::whereColumn('id', 'id')->delete();
    }

    public function save($attributes)
    {
        $office = new $this->officeModelClass;
        $office->code = $attributes['Code'];
        $office->name = $attributes['Name'];
        $office->country_code_iso = $attributes['countryCodeIso'];
        $office->work_time = $attributes['WorkTime'];
        $office->address = $attributes['Address'];
        $office->full_address = $attributes['FullAddress'];
        $office->address_comment = $attributes['AddressComment'];
        $office->email = $attributes['Email'];
        $office->phone = $attributes['Phone'];
        $office->coordinates = new Point($attributes['coordX'], $attributes['coordY']);
        $this->saveWithBuffer($office);
    }

    public function find($x, $y, $x2, $y2)
    {
        foreach ([$x, $y, $x2, $y2] as $value) {
            if (!is_numeric($value)) {
                throw new Exception('Неверные координаты');
            }
        }
        //  MBR - minimum bounding rectangle
        return $this->officeModelClass::select('*')->fixCoordinates()
            ->withinRectangle($x, $y, $x2, $y2)
            ->get();
    }

    private function saveWithBuffer($office)
    {
        $this->buffer[] = $office->getAttributes();
        if (count($this->buffer) >= $this->bufferSize) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->officeModelClass::query()->insert($this->buffer);
        $this->buffer = [];
    }
}
