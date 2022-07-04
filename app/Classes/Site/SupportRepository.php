<?php

namespace App\Classes\Site;

class SupportRepository
{
    var $site;
    var $language;

    public function __construct($site, $language)
    {
        $this->site = $site;
        $this->language = $language;
    }


    public function loadCategories()
    {
        $language = $this->language;
        $this->site->load(
            [
                'supportCategories' => function ($q) {
                    $q->orderBy('sort');
                },
                'supportCategories.supportCategoryTexts' =>
                    function ($q) use ($language) {
                        $q->where('language_id', $language->id);
                    },
                'supportCategories.supportQuestions' => function ($q) {
                    $q->orderBy('sort');
                },
                'supportCategories.supportQuestions.supportQuestionTexts' => function ($q) use ($language) {
                    $q->where('language_id', $language->id);
                },
            ]
        );
    }

}
