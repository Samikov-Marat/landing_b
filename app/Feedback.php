<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $dates = [
        'writing_date',
    ];

    public function language()
    {
        return $this->hasOne('App\Language', 'id', 'language_id');
    }


}
