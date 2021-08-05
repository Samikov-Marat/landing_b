<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class LanguageIsoAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->code_iso,
            'text' => $item->name,
            'code_iso' => $item->code_iso,
            'name' => $item->name,
        ];
    }
}
