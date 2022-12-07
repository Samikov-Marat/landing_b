<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Franchisee extends Model
{
    public function localOffices(): HasMany
    {
        return $this->hasMany(LocalOffice::class, 'franchisee_id', 'id');
    }
}
