<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TopOffice extends Model
{
    public function office(): HasOne
    {
        return $this->hasOne('App\Office', 'code', 'code');
    }

    public function worldLanguages(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\WorldLanguage',
            'App\TopOfficeWorldLanguage',
            'top_office_id',
            'world_language_id',
            'id',
            'id'
        )
            ->withPivot(
            [
                'country',
                'name',
                'full_address',
                'address_comment',
                'work_time',
                'office_hash',
            ]
        );
    }
}
