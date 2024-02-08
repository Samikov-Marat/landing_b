<?php

namespace App\Classes;

use App\Office;

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

        if($office->exists){
            $this->result = 'updated';
        }
        else{
            $this->result = 'created';
        }

        $office->uuid = $attributes['uuid'];
        $office->code = $attributes['systemName'] ?? '';
        $office->name = $attributes['name']['rus'] ?? '';
        $office->country_code_iso = '';
        $office->work_time = $this->getWorktimeString($attributes['officeWorkPeriods'] ?? []);
        $office->address = $attributes['address']['street']['rus'] ?? '' . ' ' . $attributes['address']['house']['rus'] ?? '';
        $office->full_address = $attributes['address']['street']['rus'] ?? '' . ' ' . $attributes['address']['house']['rus'] ?? '';
        $office->address_comment = $attributes['address']['comment']['rus']??'';
        $office->email = $attributes['email'] ?? '';
        $office->phone = $this->getPhoneString($attributes['officePhones']??[]);
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
