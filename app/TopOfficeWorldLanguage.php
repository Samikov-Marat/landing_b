<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TopOfficeWorldLanguage extends Pivot
{
    public function topOffice(): HasOne
    {
        return $this->hasOne('App\TopOffice', 'id', 'top_office_id');
    }

    public function worldLanguage()
    {
        return $this->hasOne('App\WorldLanguage', 'id', 'world_language_id');
    }
}
