<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TariffText extends Model
{

     public function tariff()
     {
         return $this-> belongsTo('App\Tariff');
     }
}
