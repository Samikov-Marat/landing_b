<?php

namespace App\Classes\Site;

use App\Tariff;

class TariffTranslator
{
    private $tariffIndexed;
    public function __construct($tariffIds, $language)
    {
        dd($tariffIds);
        $tariffs = Tariff::select(['id', 'ek_id'])
            ->whereIn('ek_id', $tariffIds)
            ->with([
                       'tariffTexts' => function ($query) use ($language) {
                           $query->where('language_code_iso', $language);
                       }
                   ])
            ->get();
        $this->tariffIndexed = $tariffs->pluck('tariffTexts.0', 'id');
        dd($this->tariffIndexed);
    }

    public function get($id){
        return $this->tariffIndexed[$id];
    }

}
