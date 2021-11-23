<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $dates = [
        'publication_date',
    ];

    public function newsArticleTexts(){
        return $this->hasMany('App\NewsArticleText', 'news_article_id', 'id');
    }

}
