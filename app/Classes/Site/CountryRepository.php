<?php

namespace App\Classes\Site;

use App\Country;
use App\CountryText;
use App\Language;
use PhpParser\Builder;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository
{

    private $query;

    /*public function __construct($language)
    {
        $countryTable = Country::getTableStatically();
        $countryTextTable = CountryText::getTableStatically();
        // TODO: переписать запрос на обычный join после добавления всех переводов
        $this->query = Country::query()->select(['t_country.jira_code as jira_code', 't_text.value as value'])
            ->from($countryTable, 't_country')
            ->leftJoin($countryTextTable . ' as t_text', function ($join) use ($language) {
                $join->on('t_country.id', 't_text.country_id')
                    ->where('t_text.language_id', $language->id);
            })
            ->orderBy('value')
            ->orderBy('jira_code');
    }*/

    private function getCountries (): \Illuminate\Database\Eloquent\Builder {
        return Country::query()->select(['id', 'jira_code']);
    }

    public function getStartCountries(Language $language): Collection
    {
        return $this->getCountries()
            ->where('can_send', true)
            ->get()
            ->load(['country_text' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            }]);
    }

    public function getFinishCounties(Language $language): Collection
    {
        return $this->getCountries()
            ->where('can_receive', true)
            ->get()
            ->load(['country_text' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            }]);
    }
}
