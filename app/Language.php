<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Language extends Model
{
    public function getUriAttribute()
    {
        return Str::lower($this->shortname);
    }
    public function languageIso(): HasOne
    {
        return $this->hasOne('App\LanguageIso', 'code_iso', 'language_code_iso');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function tariffTexts()
    {
        return $this->hasMany('App\TariffText', 'language_code_iso', 'language_code_iso');
    }

    public function worldLanguage()
    {
        return $this->hasOne(WorldLanguage::class, 'id','world_language_id');
    }

    public function defaultLanguageSites()
    {
        return $this->belongsToMany(Site::class, DefaultLanguage::class);
    }

}
