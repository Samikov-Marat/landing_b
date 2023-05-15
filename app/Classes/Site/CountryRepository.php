<?php

namespace App\Classes\Site;

use App\Country;
use App\CountryText;
use App\Language;
use PhpParser\Builder;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository
{
    private function getCountries(): \Illuminate\Database\Eloquent\Builder
    {
        return Country::query()->select(['id', 'jira_code']);
    }

    public function getStartCountries(Language $language): Collection
    {
        return $this->getCountries()
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
        return $this->getCountries()
            ->where('can_receive', true)
            ->get()
            ->load([
                'countryTexts' => function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
            ]);
    }
}
