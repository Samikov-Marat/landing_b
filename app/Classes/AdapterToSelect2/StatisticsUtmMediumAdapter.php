<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsUtmMediumAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->utm_medium,
            'text' => $item->utm_medium,
            'utm_medium' => $item->utm_medium,
        ];
    }
}
