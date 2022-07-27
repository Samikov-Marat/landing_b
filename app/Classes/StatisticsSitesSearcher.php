<?php

namespace App\Classes;

use App\Classes\AdapterToSelect2\StatisticsSitesAdapter;
use App\Statistics;

class StatisticsSitesSearcher
{
    const PER_PAGE = 7;
    const COLUMNS = ['site'];

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = Statistics::where('site', 'like', '%' . $escapedTerm . '%')
            ->distinct()
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new StatisticsSitesAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
