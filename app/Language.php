<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Language extends Model
{
    public function getUriAttribute()
    {
        return Str::lower($this->shortname);
    }
}
