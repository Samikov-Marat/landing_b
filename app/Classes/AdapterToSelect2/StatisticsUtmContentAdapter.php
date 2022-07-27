<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsUtmContentAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->utm_content,
            'text' => $item->utm_content,
            'utm_content' => $item->utm_content,
        ];
    }
}
