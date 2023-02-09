<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FranchiseeNewsArticle extends Model
{
    protected $dates = [
        'publication_date',
    ];

    public function franchiseeNewsArticleTexts(){
        return $this->hasMany('App\FranchiseeNewsArticleText', 'franchisee_news_article_id', 'id');
    }
}
