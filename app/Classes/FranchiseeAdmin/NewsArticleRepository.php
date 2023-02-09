<?php

namespace App\Classes\FranchiseeAdmin;

use App\Franchisee;
use App\User;

class NewsArticleRepository
{
    private $relations = [];

    public static function getInstance(): self
    {
        return new static();
    }

    public function withFranchiseeNewsArticles(): self
    {
        $this->relations['franchiseeNewsArticles.franchiseeNewsArticleTexts'] = function ($query) {
            $query->select(['id', 'franchisee_news_article_id', 'publication_date_text', 'header',]);
        };
        $this->relations['franchiseeNewsArticles'] = function ($query) {
            $query->select(['id', 'franchisee_id', 'publication_date',])
                ->orderBy('publication_date', 'desc');
        };
        return $this;
    }


    public function getFranchisee(User $user): Franchisee
    {
        return $user->franchisees()
            ->firstOrFail()
            ->load($this->relations);
    }
}
