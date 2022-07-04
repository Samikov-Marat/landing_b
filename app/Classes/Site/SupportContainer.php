<?php

namespace App\Classes\Site;

use App\SupportCategory;
use Illuminate\Support\Collection;

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
        $this->tree = collect();

        $supportRepository = new SupportRepository($this->site, $this->language);
        $supportRepository->loadCategories();
        $this->prepareTree();
    }

    public function prepare()
    {
        $language = $this->language;
        if (isset($this->category)) {
            $this->currentSupportCategory = SupportCategory::select(['id', 'parent_id', 'icon_class',])
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
            $this->supportCategories = SupportCategory::select(['id', 'parent_id', 'icon_class',])
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
            $this->supportCategories = SupportCategory::select(['id', 'parent_id', 'icon_class',])
                ->where('site_id', $this->site->id)
                ->whereNull('parent_id')
                ->get();
        }

        if (isset($this->question)) {
            $this->supportQuestion = $this->currentSupportCategory->supportQuestions()
                ->select(['id', 'category_id', 'show_form'])
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


    private function prepareTree($parent_id = null)
    {
        $this->tree = $this->getBranch($parent_id);
    }

    private function getBranch($parent_id = null, $level = 0): Collection
    {
        if ($level > 16) {
            abort(500);
        }
        $children = collect();
        foreach ($this->site->supportCategories as $category) {
            if ($parent_id == $category->parent_id) {
                $category->subCategories = $this->getBranch($category->id, $level + 1);
                $children[] = $category;
            }
        }
        return $children;
    }
}
