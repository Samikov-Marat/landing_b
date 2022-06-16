<?php

namespace App\Classes\Site;

use App\SupportCategory;

class SupportContainer
{
    var $site;
    var $language;
    var $category;
    var $question;

    var $currentSupportCategory;
    var $supportCategories;
    var $supportQuestion;
    var $path;

    public function __construct($site, $language, $category, $question)
    {
        $this->site = $site;
        $this->language = $language;
        $this->category = $category;
        $this->question = $question;
        $this->path = collect();
    }

    public function prepare()
    {
        $language = $this->language;
        if (isset($this->category)) {
            $this->currentSupportCategory = SupportCategory::select(['id', 'parent_id'])
                ->findOrFail($this->category);


            $this->currentSupportCategory->load(
                [
                    'supportCategoryTexts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id);
                    },
                    'supportQuestions' => function ($q) {
                        $q->orderBy('sort');
                    },
                    'supportQuestions.supportQuestionTexts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id);
                    },

                ]
            );

            $this->preparePath();
        }

        if (isset($this->category)) {
            $this->supportCategories = SupportCategory::select(['id', 'parent_id'])
                ->where('site_id', $this->site->id)
                ->where('parent_id', $this->category)
                ->get();

            $this->supportCategories->load(
                [
                    'supportCategoryTexts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id);
                    },
                ]
            );
        } else {
            $this->supportCategories = SupportCategory::select(['id', 'parent_id'])
                ->where('site_id', $this->site->id)
                ->whereNull('parent_id')
                ->get();
        }

        if (isset($this->question)) {
            $this->supportQuestion = $this->currentSupportCategory->supportQuestions()
                ->select(['id', 'category_id'])
                ->findOrFail($this->question);

            $this->supportQuestion->load(
                [
                    'supportQuestionTexts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id);
                    },
                ]
            );
        }
    }

    private function preparePath()
    {
        $supportRepository = new SupportRepository($this->site, $this->language);
        $supportRepository->loadCategories();
        $supportCategoryInPath = $this->currentSupportCategory->id;

        while (!is_null($supportCategoryInPath)) {
            foreach ($this->site->supportCategories as $supportCategory) {
                if ($supportCategory->id == $supportCategoryInPath) {
                    $this->path->prepend($supportCategory);
                    $supportCategoryInPath = $supportCategory->parent_id;
                    break;
                }
            }
        }
    }

}
