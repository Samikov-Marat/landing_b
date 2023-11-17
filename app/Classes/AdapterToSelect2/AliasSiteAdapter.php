<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

class AliasSiteAdapter
{
    public function convert(Model $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'domain' => $item->domain
        ];
    }
}
