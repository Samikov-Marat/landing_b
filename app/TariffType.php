<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TariffType extends Model
{
    public function tariffTypeTexts()
    {
        return $this->hasMany('App\TariffTypeText');
    }
}
