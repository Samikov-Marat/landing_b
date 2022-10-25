<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormRequest extends Model
{
    public function formRequestFields(): HasMany
    {
        return $this->hasMany(FormRequestField::class, 'form_request_id', 'id');
    }
}
