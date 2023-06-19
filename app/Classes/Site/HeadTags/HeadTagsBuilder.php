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
    private $canonical;
    private $lang;
    private $alternate;

    public function __construct (
        CanonicalTagBuilder $canonical,
        LangTagBuilder $lang,
        AlternateTagBuilder $alternate
    ) {
        $this->canonical = $canonical;
        $this->lang = $lang;
        $this->alternate = $alternate;
    }

    public function getTags (Site $site, Page $page, Language $language): array {
        $tags = [];
        $tags['lang'] = $this->lang->create($site, $page, $language);

        if ('cdek-de.com' === $site->domain) {
            $tags['canonical'] = $this->canonical->create($site, $page, $language, 'de');
        }

        $tags['alternate'] = $this->alternate->create($site, $page, $language);

        return $tags;
    }
}