<?php

namespace App\Classes;

use App\Classes\AdapterToSelect2\AliasSiteAdapter;
use App\Site;

class AliasSitesSearcher
{
    const PER_PAGE = 7;
    const COLUMNS = ['id', 'name', 'domain'];

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = Site::where('name', 'like', '%' . $escapedTerm . '%')
            ->distinct()
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new AliasSiteAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
