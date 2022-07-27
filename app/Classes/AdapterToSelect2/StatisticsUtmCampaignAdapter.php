<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class StatisticsUtmCampaignAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->utm_campaign,
            'text' => $item->utm_campaign,
            'utm_campaign' => $item->utm_campaign,
        ];
    }
}
