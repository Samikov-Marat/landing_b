<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsSitesAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->site,
            'text' => $item->site,
            'site' => $item->site,
        ];
    }
}
