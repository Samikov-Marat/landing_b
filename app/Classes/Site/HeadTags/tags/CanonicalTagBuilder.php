<?php

namespace App\Classes\Site\HeadTags\tags;

use App\Classes\Site\HeadTags\TagBuilder;
use App\Language;
use App\Page;
use App\Site;

class CanonicalTagBuilder implements TagBuilder
{
    public static function tagName(): string
    {
        return 'canonical';
    }

    private const AVAILABLE_DOMAINS_WITH_LANG = [
        'cdek-de.com' => 'de',
    ];

    public function create(Site $site, Page $page, Language $language): array
    {
        if (array_key_exists($site->domain, self::AVAILABLE_DOMAINS_WITH_LANG)) {
            return [
                "<{$this->createTag(self::AVAILABLE_DOMAINS_WITH_LANG[$site->domain])}>",
            ];
        }
        return [];
    }

    private function createTag(string $languageUri): string
    {
        return collect([
            "link",
            "rel={$this->createRel()}",
            "href={$this->createHref($languageUri)}",
        ])->join(' ');
    }

    private function createRel(): string
    {
        return 'canonical';
    }

    private function createHref(string $languageUri): string
    {
        return route('site.show_page', ['languageUrl' => $languageUri, 'pageUrl' => '/']);
    }
}