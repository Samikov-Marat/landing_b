<?php

namespace App\Classes\FranchiseeAdmin;

class FranchiseeNewsArticleRepository
{
    private $franchisee;

    public function __construct($franchisee)
    {
        $this->franchisee = $franchisee;
    }

    public static function getInstance($franchisee): self
    {
        return new static($franchisee);
    }

    public function load()
    {
        $this->franchisee->load([
                       'franchiseeNewsArticles.franchiseeNewsArticleTexts' => function ($query) {
                           $query->select(['id', 'franchisee_news_article_id', 'publication_date_text', 'header',]);
                       },
                       'franchiseeNewsArticles' => function ($query) {
                           $query->select(['id', 'franchisee_id', 'publication_date',])
                               ->orderBy('publication_date', 'desc');
                       },
                   ]
            );
    }
}
