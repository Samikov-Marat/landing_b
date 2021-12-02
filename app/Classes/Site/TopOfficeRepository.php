<?php

namespace App\Classes\Site;

use App\WorldLanguage;

class TopOfficeRepository
{
    public static function getInstance(): self
    {
        return new static();
    }

    public function getList(array $priorityLanguageList)
    {
        $worldLanguages = WorldLanguage::select(['id', 'language_code_iso'])
            ->whereIn('language_code_iso', $priorityLanguageList)
            ->get();

        $worldLanguage = $worldLanguages->sortBy(function ($worldLanguage, $key) use ($priorityLanguageList) {
            return array_search($worldLanguage->language_code_iso, $priorityLanguageList);
        })->first();

        $worldLanguage->load([
                                 'topOffices' => function ($q) {
                                     $q->orderBy('sort');
                                 },
                                'topOffices.office',
                             ]);
        return $worldLanguage->topOffices;
    }
}
