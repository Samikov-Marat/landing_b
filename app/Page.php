<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    public function textTypes(): HasMany
    {
        return $this->hasMany(TextType::class, 'page_id', 'id');
    }

    public function getSpecificTextType(string $textTypeName): Model
    {
        return $this->textTypes()->where('shortname', $textTypeName)->first();
    }
}
