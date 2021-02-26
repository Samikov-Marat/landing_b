<?php

namespace App\Classes;

use App\Office;

class OfficeRepository
{
    var $buffer = [];
    var $bufferSize;

    function __construct($bufferSize = 100)
    {
        $this->bufferSize = $bufferSize;
    }

    function __destruct()
    {
        $this->flush();
    }

    public function clear()
    {
        Office::whereColumn('id', 'id')->delete();
    }

    public function save($attributes)
    {
        $office = new Office();
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
                throw new \Exception('Неверные координаты');
            }
        }
        //  MBR - minimum bounding rectangle
        return Office::select('*')->fixCoordinates()
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
        Office::query()->insert($this->buffer);
        $this->buffer = [];
    }
}
