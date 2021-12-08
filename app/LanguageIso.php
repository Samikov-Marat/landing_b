<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageIso extends Model
{
    public $timestamps = false;
    protected $table = 'language_iso';

    public function languages()
    {
        return $this->hasMany(Language::class, 'language_code_iso', 'code_iso' );
    }

    public function tariffTexts()
    {
        return $this->hasMany(TariffText::class, 'language_code_iso', 'code_iso');
    }

    public function tariffTypeTexts()
    {
        return $this->hasMany(TariffTypeText::class, 'language_code_iso', 'code_iso');
    }
}

