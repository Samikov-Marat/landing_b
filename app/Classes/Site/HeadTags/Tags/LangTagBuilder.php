<?php

namespace App\Classes\Site\HeadTags\Tags;

use App\Language;
use App\Page;
use App\Site;

class LangTagBuilder implements TagBuilder
{
    public static function tagName(): string
    {
        return 'lang';
    }

    public function create(Site $site, Page $page, Language $language): array
    {
        return [
            "<{$this->createTag($language)}>",
        ];
    }

    private function createTag(Language $language): string
    {
        return collect([
            "html",
            "lang={$this->getTagLanguage($language)}",
        ])->join(' ');
    }

    private function getTagLanguage(Language $language): string
    {
        if (empty($language->language_code_iso)) {
            return '';
        }
        return $language->language_code_iso . '-' . \Str::upper($language->language_code_iso);
    }
}