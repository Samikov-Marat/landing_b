<?php

namespace App\Classes\AdapterToSelect2;

use Illuminate\Database\Eloquent\Model;

interface AdapterModelToSelect2Item
{
    public function convert(Model $item):array;
}
