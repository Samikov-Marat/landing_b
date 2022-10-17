<?php

namespace App\Classes\Site;

use App\Country;
use App\CountryText;

class CountryRepository
{

    private $query;

    public static function getInstance($language): self
    {
        return new static($language);
    }

    public function __construct($language)
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
    }

    public function getStartCountries()
    {
        return $this->query->where('t_country.can_send', true)
            ->get();
    }

    public function getFinishCounties()
    {
        return $this->query->where('t_country.can_receive', true)
            ->get();
    }
}
