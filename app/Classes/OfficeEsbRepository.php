<?php

namespace App\Classes;

use App\Office;
use Illuminate\Support\Arr;

class OfficeEsbRepository
{
    private $fromEsb;
    public $result = 'none';
    public function __construct(bool $fromEsb)
    {
        $this->fromEsb = $fromEsb;
    }

    public function save(array $attributes)
    {
        $office = Office::where('uuid', $attributes['uuid'])
            ->firstOrNew();
        if ($office->exists && $office->from_esb && !$this->fromEsb) {
            $this->result = 'overdue';
            return;
        }
        if (($attributes['status'] !== 'ACTIVE') && $office->exists) {
            $this->result = 'deleted';
            $office->delete();
        }
        if ($attributes['status'] !== 'ACTIVE') {
            return;
        }
        if(!isset($attributes['address']['longitude'])){
            return;
        }
        if(!isset($attributes['address']['latitude'])){
            return;
        }

        if($office->exists){
            $this->result = 'updated';
        }
        else{
            $this->result = 'created';
        }

        $office->uuid = $attributes['uuid'];
        $office->code = Arr::get($attributes, 'systemName', '');
        $office->name = Arr::get($attributes, 'name.rus', '');
        $office->country_code_iso = '';
        $office->work_time = $this->getWorktimeString(Arr::get($attributes, 'officeWorkPeriods', []));
        $office->address = Arr::get($attributes, 'address.street.rus', '') . ' ' . Arr::get($attributes, 'address.house.rus', '');
        $office->full_address = Arr::get($attributes, 'address.street.rus', '') . ' ' . Arr::get($attributes, 'address.house.rus', '');
        $office->address_comment = Arr::get($attributes, 'address.comment.rus', '');
        $office->email = Arr::get($attributes, 'email', '');
        $office->phone = $this->getPhoneString(Arr::get($attributes, 'officePhones', ''));
        $office->coordinates = new Point($attributes['address']['longitude'], $attributes['address']['latitude']);
        $office->save();
    }


    private function getWorktimeString(array $officeWorkPeriods)
    {
        $worktime = [];
        foreach ($officeWorkPeriods as $period) {
            $worktime[] = $period['weekdayBegin'] . '-' . $period['weekdayEnd'] . ' ' .
                $period['workTimeBeginStr'] . '-' . $period['workTimeEndStr'];
        }
        return implode('; ', $worktime);
    }

    private function getPhoneString(array $officePhones)
    {
        $phones = [];
        foreach ($officePhones as $phone) {
            if ('MOBILE' == $phone['phoneTypeCode']) {
                $phones[] = 'моб:' . $phone['phoneNumber'];
            } else {
                $phones[] = $phone['phoneNumber'];
            }
        }
        return implode(', ', $phones);
    }
}
