<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportQuestion extends Model
{
    public function supportQuestionTexts(): HasMany
    {
        return $this->hasMany(SupportQuestionText::class, 'question_id', 'id');
    }
}
