<?php

namespace App\Classes\Admin;

use App\Site;
use App\SupportCategory;
use App\SupportQuestion;
use Illuminate\Database\Eloquent\Collection;

class SupportCloner
{
    // Сайт для клонирования техподдержки при подключении страницы
    public const DEFAULT_SOURCE_SITE_ID = 13;

    private $site;

    private $languageAnalog;

    public function __construct(Site $site)
    {
        $this->site = $site;
        $this->site->load('supportCategories')
            ->load('languages');
    }

    public static function containsSupport(Collection $pages)
    {
        return $pages->contains(function ($page) {
            return 'support' == $page->url;
        });
    }

    public function cloneSupport(Site $source)
    {
        if ($this->haveSiteSupportCategories()) {
            return;
        }
        $this->languageAnalog = $this->site->languages->pluck('language_code_iso', 'id');
        $languageAnalog = $this->languageAnalog;

        $source->load('supportCategories.supportQuestions')
            ->load(
                [
                    'languages' => function ($q) use ($languageAnalog) {
                        $q->whereIn('language_code_iso', $languageAnalog);
                    }
                ]
            );
        $sourceLanguageIds = $source->languages->pluck('id');
        $source->load(
            [
                'supportCategories.supportCategoryTexts' => function ($q) use ($sourceLanguageIds) {
                    $q->whereIn('language_id', $sourceLanguageIds);
                },
                'supportCategories.supportQuestions.supportQuestionTexts' => function ($q) use ($sourceLanguageIds) {
                    $q->whereIn('language_id', $sourceLanguageIds);
                },
            ]
        );
        $this->cloneCategories($source);
    }

    private function cloneCategories(Site $source)
    {
        foreach ($source->supportCategories as $category) {
            $clone = $category->replicate(['site_id']);
            $clone->site_id = $this->site->id;
            $clone->save();
            $this->cloneCategoryTexts($clone, $category, $source);
            $this->cloneQuestions($clone, $category, $source);
        }
    }

    private function cloneCategoryTexts(SupportCategory $newCategory, SupportCategory $oldCategory, Site $source)
    {
        $sourceLanguageAnalog = $source->languages->pluck('language_code_iso', 'id');
        foreach ($oldCategory->supportCategoryTexts as $text) {
            $clone = $text->replicate(['category_id', 'language_id']);
            $clone->category_id = $newCategory->id;
            $clone->language_id = $this->languageAnalog->search($sourceLanguageAnalog[$text->language_id]);
            $clone->save();
        }
    }

    private function cloneQuestions(SupportCategory $newCategory, SupportCategory $oldCategory, Site $source)
    {
        foreach ($oldCategory->supportQuestions as $question) {
            $clone = $question->replicate(['category_id']);
            $clone->category_id = $newCategory->id;
            $clone->save();
            $this->cloneQuestionTexts($clone, $question, $source);
        }
    }

    private function cloneQuestionTexts(SupportQuestion $newQuestion, SupportQuestion $oldQuestion, Site $source)
    {
        $sourceLanguageAnalog = $source->languages->pluck('language_code_iso', 'id');
        foreach ($oldQuestion->supportQuestionTexts as $text) {
            $clone = $text->replicate(['question_id', 'language_id']);
            $clone->question_id = $newQuestion->id;
            $clone->language_id = $this->languageAnalog->search($sourceLanguageAnalog[$text->language_id]);
            $clone->save();
        }
    }

    public function haveSiteSupportCategories(): bool
    {
        return $this->site->supportCategories->count() > 0;
    }
}
