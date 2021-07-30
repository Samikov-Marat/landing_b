<?php


namespace App\Classes;


use App\Office;

class OfficeHash
{
    var $office;

    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    public static function getInstance(Office $office)
    {
        return new static($office);
    }

    public function getHash()
    {
        return md5(
            $this->office->code . $this->office->name . $this->office->address . $this->office->full_address . $this->office->work_time
        );
    }


}
