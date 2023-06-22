<?php

namespace App\Classes\Site\HeadTags\tags;

use App\Classes\Site\HeadTags\TagBuilder;
use App\Language;
use App\Page;
use App\Site;

class AlternateTagBuilder implements TagBuilder
{
    public static function tagName(): string
    {
        return 'alternate';
    }

    public function create(Site $site, Page $page, Language $language): array
    {
        return $site->languages->map(function ($item) use ($language, $page) {
            return "<{$this->createTag($item, $language, $page)}>";
        })->toArray();
    }

    private function createTag(Language $language, Language $currentLanguage, Page $page): string
    {
        return collect([
            "link",
            "rel={$this->createRel()}",
            "href={$this->createHref($language, $page)}",
            "hreflang={$this->createHreflang($language, $currentLanguage)}",
        ])->join(' ');
    }

    private function createRel(): string
    {
        return "alternate";
    }

    private function createHref(Language $language, Page $page): string
    {
        return route('site.show_page',
            ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url]);
    }

    private function createHreflang(Language $language, Language $currentLanguage): string
    {
        return $language->id === $currentLanguage->id ? 'x-default' : $language->shortname;
    }
}