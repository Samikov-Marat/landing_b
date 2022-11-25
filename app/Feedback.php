<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $dates = [
        'writing_date',
    ];

    public function language(): HasOne
    {
        return $this->hasOne('App\Language', 'id', 'language_id');
    }


}
