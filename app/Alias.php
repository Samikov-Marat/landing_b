<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Alias extends Model
{
    public function site(): HasOne
    {
        return $this->hasOne(Site::class, 'id', 'site_id');
    }
}
