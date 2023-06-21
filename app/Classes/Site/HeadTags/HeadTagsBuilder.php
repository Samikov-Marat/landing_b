<?php

namespace App\Classes\Site\HeadTags;

use App\Classes\Site\HeadTags\tags\AlternateTagBuilder;
use App\Classes\Site\HeadTags\tags\CanonicalTagBuilder;
use App\Classes\Site\HeadTags\tags\LangTagBuilder;
use App\Language;
use App\Page;
use App\Site;

class HeadTagsBuilder
{
    private $tagsBuilders = [];

    public function __construct(
        CanonicalTagBuilder $canonical,
        LangTagBuilder $lang,
        AlternateTagBuilder $alternate
    ) {
        $this->tagsBuilders = [
            $canonical,
            $lang,
            $alternate
        ];
    }

    public function getTags(Site $site, Page $page, Language $language): array
    {
        $tags = [];
        foreach ($this->tagsBuilders as $tagsBuilder) {
            $tags[$tagsBuilder::TAG_NAME] = $tagsBuilder->create($site, $page, $language);
        }

        return $tags;
    }

}