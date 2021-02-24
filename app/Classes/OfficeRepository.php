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
        $office->coord_x = $attributes['coordX'];
        $office->coord_y = $attributes['coordY'];

        if (1 == $this->bufferSize) {
            $office->save();
        } else {
            $this->saveWithBuffer($office->toArray());
        }
    }

    private function saveWithBuffer(array $values)
    {
        $this->buffer[] = $values;
        if (count($this->buffer) >= $this->bufferSize) {
            $this->flush();
        }
    }

    function __destruct()
    {
        $this->flush();
    }

    public function flush()
    {
        Office::query()->insert($this->buffer);
        $this->buffer = [];
    }

}
