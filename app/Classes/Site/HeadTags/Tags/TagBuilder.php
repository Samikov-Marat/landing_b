<?php

namespace App\Classes\Site\HeadTags\Tags;

use App\Language;
use App\Page;
use App\Site;

interface TagBuilder
{
    public static function tagName(): string;

    public function create(Site $site, Page $page, Language $language): array;
}
