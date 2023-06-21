<?php

namespace App\Classes\Site\HeadTags\tags;

use App\Classes\Site\HeadTags\TagBuilder;
use App\Language;
use App\Page;
use App\Site;

class AlternateTagBuilder implements TagBuilder
{
    public const TAG_NAME = 'alternate';

    public function create(Site $site, Page $page, Language $language): array
    {
        return $site->languages->map(function ($item) use ($language, $page) {
            return "<{$this->createTag($item, $language, $page)}>";
        })->toArray();
    }

    private function createTag(Language $language, Language $currentLanguage, Page $page)
    {
        return collect([
            "link",
            "rel={$this->createRel()}",
            "href={$this->createHref($language, $page)}",
            "hreflang={$this->createHreflang($language, $currentLanguage)}",
        ])->join(' ');
    }

    private function createRel()
    {
        return "alternate";
    }

    private function createHref(Language $language, Page $page)
    {
        return route('site.show_page',
            ['languageUrl' => \Str::lower($language->shortname), 'pageUrl' => $page->url]);
    }

    private function createHreflang(Language $language, Language $currentLanguage)
    {
        return $language->id === $currentLanguage->id ? 'x-default' : $language->shortname;
    }
}