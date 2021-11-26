<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'ek_id',
        'tariff_type_id'
    ];

    public function tariffTexts()
    {
        return $this->hasMany('App\TariffText');
    }

    public function tariffType()
    {
        return $this->hasOne('App\TariffType', 'id', 'tariff_type_id');
    }

}
