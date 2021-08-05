<?php

namespace App\Classes;

use App\Classes\AdapterToSelect2\LanguageIsoAdapter;
use App\LanguageIso;

class LanguageIsoSearcher
{
    const PER_PAGE = 7;
    const COLUMNS = ['code_iso', 'name'];

    public static function getInstance(): self
    {
        return new self();
    }

    public static function search($term, $page): Select2SearchResult
    {
        $escapedTerm = str_replace(['%', '_'], ['\\%', '\\_'], $term);
        $paginator = LanguageIso::where('name', 'like', '%' . $escapedTerm . '%')
            ->simplePaginate(
                self::PER_PAGE,
                self::COLUMNS,
                'page',
                $page
            );
        $adapter = new LanguageIsoAdapter();
        return new Select2SearchResult($paginator, $adapter);
    }
}
