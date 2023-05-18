<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TextType extends Model
{
    public function texts(): HasMany
    {
        return $this->hasMany(Text::class, 'text_type_id', 'id');
    }

    public function getSpecificText(int $language): Model
    {
        return $this->texts()->where('language_id', $language)->first();
    }

    public function franchiseeTexts(): HasMany
    {
        return $this->hasMany(FranchiseeText::class, 'text_type_id', 'id');
    }
}
