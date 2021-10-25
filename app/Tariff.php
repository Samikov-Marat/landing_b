<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'ek_id',
        'tariff_type_id'
    ];

    public function tariffText()
    {
        return $this->hasMany('App\TariffText');
    }

}
