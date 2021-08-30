<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $dates = [
        'publication_date',
    ];
}
