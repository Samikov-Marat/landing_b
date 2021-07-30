<?php


namespace App\Classes;


use App\Classes\AdapterToSelect2\AdapterModelToSelect2Item;
use Illuminate\Pagination\Paginator;

class Select2SearchResult
{
    var $paginator;
    var $converter;

    public function __construct(Paginator $paginator, $converter)
    {
        $this->paginator = $paginator;
        $this->converter = $converter;
    }

    public function asArray(): array
    {
        $results = [];
        foreach ($this->paginator->items() as $item) {
            $results[] = $this->converter->convert($item);
        }
        return [
            'results' => $results,
            'pagination' => ['more' => $this->paginator->hasMorePages()]
        ];
    }
}
