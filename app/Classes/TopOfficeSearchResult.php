<?php


namespace App\Classes;


class TopOfficeSearchResult
{
    var $simplePaginator;

    public function __construct($simplePaginator)
    {
        $this->simplePaginator = $simplePaginator;
    }

    public function asArray(): array
    {
        return Select2DataArray::getStructured(
            $this->simplePaginator->items(),
            $this->simplePaginator->hasMorePages()
        );
    }

}
