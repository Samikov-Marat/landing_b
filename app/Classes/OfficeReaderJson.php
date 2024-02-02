<?php

namespace App\Classes;

use App\Office;

class OfficeReaderJson
{
    public function save(string $officeJson)
    {
        $attributes = json_decode($officeJson, true);
        $office = Office::where('code', $attributes['systemName'])
            ->firstOrNew();

        $office->code = $attributes['systemName'];
        $office->name = $attributes['name']['rus'];
        $office->country_code_iso = '';
        $office->work_time = $this->getWorktimeString($attributes['officeWorkPeriods']);
        $office->address = $attributes['address']['street']['rus'] . ' ' . $attributes['address']['house']['rus'];
        $office->full_address = $attributes['address']['street']['rus'] . ' ' . $attributes['address']['house']['rus'];
        $office->address_comment = $attributes['address']['comment']['rus'];
        $office->email = $attributes['email'];
        $office->phone = $this->getPhoneString($attributes['officePhones']);
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
