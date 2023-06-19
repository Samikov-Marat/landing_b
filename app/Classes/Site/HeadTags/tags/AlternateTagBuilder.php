<?php

namespace App\Classes\Site\HeadTags\tags;

use App\Classes\Site\HeadTags\TagBuilder;
use App\Language;
use App\Page;
use App\Site;

class AlternateTagBuilder implements TagBuilder
{
    public function create(Site $site, Page $page, Language $language): array
    {
        $linkRel = 'alternate';

        return $site->languages->map(function ($item) use ($language, $page, $linkRel) {
            $route = route('site.show_page',
                ['languageUrl' => \Str::lower($item->shortname), 'pageUrl' => $page->url]);
            $hreflang = $item->id === $language->id ? 'x-default' : $item->shortname;

            return "<link rel={$linkRel} href={$route} hreflang={$hreflang}>";
        })->toArray();
    }
}