<?php

namespace App\Classes\Site\HeadTags\tags;

use App\Classes\Site\HeadTags\TagBuilder;
use App\Language;
use App\Page;
use App\Site;

class CanonicalTagBuilder implements TagBuilder
{
    public function create(Site $site, Page $page, Language $language, $languageUri = ''): string
    {
        $linkRel = 'canonical';
        $route = route('site.show_page', ['languageUrl' => $languageUri, 'pageUrl' => '/']);
        return "<link rel={$linkRel} href={$route}>";
    }
}