<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsUtmSourceAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->utm_source,
            'text' => $item->utm_source,
            'utm_source' => $item->utm_source,
        ];
    }
}
