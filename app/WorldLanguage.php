<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WorldLanguage extends Model
{
    public function languageIso(): HasOne
    {
        return $this->hasOne('App\LanguageIso', 'code_iso', 'language_code_iso');
    }

    public function topOffices(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\TopOffice',
            'App\TopOfficeWorldLanguage',
            'world_language_id',
            'top_office_id',
            'id',
            'id'
        )->withPivot(
            [
                'name',
                'country',
                'full_address',
                'address_comment',
                'work_time',
                'office_hash',
            ]
        );
    }
}
