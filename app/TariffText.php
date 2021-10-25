<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TariffText extends Model
{

     public function tariff()
     {
         return $this-> belongsTo('App\Tariff');
     }

     public function languageIso()
     {
         return $this->belongsTo(LanguageIso::class, 'code_iso', 'language_code_iso');
     }
}
