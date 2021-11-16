<?php

namespace App\Classes\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsArticleTextHelper
{
    private $hasManyRelation;

    const FIELDS = [
        'id',
        'news_article_id',
        'language_id',
        'header',
        'note',
        'text',
        'publication_date_text',
    ];

    public function __construct(HasMany $hasManyRelation)
    {
        $this->hasManyRelation = $hasManyRelation;
    }

    public static function getInstance(HasMany $hasManyRelation)
    {
        return new static($hasManyRelation);
    }

    public function getFirstOrNewByLanguage($language_id)
    {
        try {
            return $this->hasManyRelation->select(static::FIELDS)
                ->where('language_id', $language_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->hasManyRelation->make()
                ->setAttribute('language_id', $language_id);
        }
    }
}
