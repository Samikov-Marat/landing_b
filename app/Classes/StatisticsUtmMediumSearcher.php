<?php

namespace App\Classes;


use App\Classes\AdapterToSelect2\StatisticsUtmMediumAdapter;
use App\Statistics;

class StatisticsUtmMediumSearcher
{
    const PER_PAGE = 7;
    const COLUMNS = ['utm_medium'];

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = Statistics::where('utm_medium', 'like', '%' . $escapedTerm . '%')
            ->distinct()
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new StatisticsUtmMediumAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
