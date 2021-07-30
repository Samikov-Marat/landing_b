<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class OfficeAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->code,
            'text' => $item->full_address,
            'code' => $item->code,
            'full_address' => $item->full_address,
        ];
    }
}
