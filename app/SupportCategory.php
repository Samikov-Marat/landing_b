<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportCategory extends Model
{
    public function supportCategoryTexts(): HasMany
    {
        return $this->hasMany(SupportCategoryText::class, 'category_id', 'id');
    }

    public function supportQuestions(): HasMany
    {
        return $this->hasMany(SupportQuestion::class, 'category_id', 'id');
    }
}
