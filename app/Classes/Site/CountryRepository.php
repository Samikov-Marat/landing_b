<?php

namespace App\Classes\Site;

use App\Country;
use App\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class CountryRepository
{
    public function getStartCountries(Language $language): Collection
    {
        return $this->getCountriesQuery()
            ->where('can_send', true)
            ->get()
            ->load([
                'countryTexts' => function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
            ]);
    }

    public function getFinishCounties(Language $language): Collection
    {
        return $this->getCountriesQuery()
            ->where('can_receive', true)
            ->get()
            ->load([
                'countryTexts' => function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
            ]);
    }

    private function getCountriesQuery(): Builder
    {
        return Country::query()
            ->select(['id', 'jira_code']);
    }
}
