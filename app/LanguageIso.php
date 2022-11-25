<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LanguageIso extends Model
{
    public $timestamps = false;
    protected $table = 'language_iso';

    public function languages(): HasMany
    {
        return $this->hasMany(Language::class, 'language_code_iso', 'code_iso');
    }

    public function tariffTexts(): HasMany
    {
        return $this->hasMany(TariffText::class, 'language_code_iso', 'code_iso');
    }

    public function tariffTypeTexts(): HasMany
    {
        return $this->hasMany(TariffTypeText::class, 'language_code_iso', 'code_iso');
    }
}

