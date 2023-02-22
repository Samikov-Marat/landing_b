<?php

namespace App\Classes;

use App\Site;

class NewsArticleRepository
{
    private $relations = [];

    public static function getInstance()
    {
        return new static();
    }

    public function withNewsArticles()
    {
        $this->relations['newsArticles.newsArticleTexts'] = function ($query) {
            $query->select(['id', 'news_article_id', 'publication_date_text', 'header',]);
        };
        $this->relations['newsArticles'] = function ($query) {
            $query->select(['id', 'site_id', 'publication_date',])
                ->orderBy('publication_date', 'desc');
        };
        return $this;
    }

    public function withLanguages()
    {
        $this->relations['languages'] = function ($query) {
            $query->select(['id', 'site_id', 'shortname', 'name'])
                ->orderBy('sort');
        };
        return $this;
    }

    public function getSite($site_id)
    {
        return Site::select('id', 'name', 'domain')
            ->with($this->relations)
            ->find($site_id);
    }
}
