<?php

namespace App\Classes;


use App\Classes\AdapterToSelect2\StatisticsUtmTermAdapter;
use App\Statistics;

class StatisticsUtmTermSearcher
{
    const PER_PAGE = 7;
    const COLUMNS = ['utm_term'];

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = Statistics::where('utm_term', 'like', '%' . $escapedTerm . '%')
            ->distinct()
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new StatisticsUtmTermAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
