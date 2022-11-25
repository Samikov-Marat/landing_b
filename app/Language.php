<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Language extends Model
{
    public function getUriAttribute(): string
    {
        return Str::lower($this->shortname);
    }

    public function languageIso(): HasOne
    {
        return $this->hasOne('App\LanguageIso', 'code_iso', 'language_code_iso');
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function tariffTexts(): HasMany
    {
        return $this->hasMany('App\TariffText', 'language_code_iso', 'language_code_iso');
    }

    public function worldLanguage(): HasOne
    {
        return $this->hasOne(WorldLanguage::class, 'id', 'world_language_id');
    }

    public function defaultLanguageSites(): BelongsToMany
    {
        return $this->belongsToMany(Site::class, DefaultLanguage::class);
    }

}
