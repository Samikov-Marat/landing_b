<?php

namespace App\Classes\Site;

use App\Language;

class FranchiseeContainer
{
    public $franchiseeNewsArticles;

    public function __construct(Language $language, Subdomain $subdomain)
    {
        if ($subdomain->hasSubdomain()) {

            $franchisee = $subdomain->getFranchisee();
            $franchisee->load(
                [
                    'franchiseeNewsArticles.franchiseeNewsArticleTexts' => function ($query) use ($language) {
                        $query->select([
                                           'id',
                                           'franchisee_news_article_id',
                                           'header',
                                           'note',
                                           'text',
                                           'publication_date_text',
                                       ])
                            ->where('language_id', $language->id);
                    },
                    'franchiseeNewsArticles' => function ($query) {
                        $query->select([
                                           'id',
                                           'franchisee_id',
                                           'publication_date',
                                           'preview',
                                           'image',
                                           'image2',
                                           'mobile',
                                           'mobile2',

                                       ])
                            ->orderBy('publication_date', 'desc');
                    },
                ]
            );
            $this->franchiseeNewsArticles = $franchisee->franchiseeNewsArticles;
        }
    }
}
