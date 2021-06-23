<?php

namespace App\Classes;

use App\Office;

class TopOfficeSearcher
{
    var $term;
    var $page;

    const PER_PAGE = 7;

    public function __construct($term, $page)
    {
        $this->term = $term;
        $this->page = $page;
    }

    public static function getInstance($term, $page): self
    {
        return new self($term, $page);
    }

    public function search(): TopOfficeSearchResult
    {
        return new TopOfficeSearchResult($this->getPaginator());
    }

    private function getPaginator()
    {
        return Office::where('full_address', 'like', '%' . $this->term . '%')
            ->simplePaginate(
                self::PER_PAGE,
                ['id', 'code', 'full_address'],
                'page',
                $this->page
            );
    }


}
