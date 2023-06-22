<?php

namespace App\Classes\Site\HeadTags;

use App\Language;
use App\Page;
use App\Site;
use Illuminate\Support\Collection;

interface TagBuilder
{
    public static function tagName(): string;

    public function create(Site $site, Page $page, Language $language): array;
}