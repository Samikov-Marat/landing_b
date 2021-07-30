<?php

namespace App\Classes;

use App\Classes\AdapterToSelect2\OfficeAdapter;
use App\Office;

class TopOfficeSearcher
{
    var $term;
    var $page;

    const PER_PAGE = 7;

    const COLUMNS = ['id', 'code', 'full_address'];

    var $paginator;

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = Office::where('full_address', 'like', '%' . $escapedTerm . '%')
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new OfficeAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
