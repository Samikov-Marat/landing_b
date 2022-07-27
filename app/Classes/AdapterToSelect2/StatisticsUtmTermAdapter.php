<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsUtmTermAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->utm_term,
            'text' => $item->utm_term,
            'utm_term' => $item->utm_term,
        ];
    }
}
