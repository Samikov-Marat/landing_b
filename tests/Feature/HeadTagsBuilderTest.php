<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\HeadTagsBuilder;
use App\Classes\Site\HeadTags\Tags\AlternateTagBuilder;
use App\Classes\Site\HeadTags\Tags\CanonicalTagBuilder;
use App\Classes\Site\HeadTags\Tags\LangTagBuilder;
use App\Language;
use App\Page;
use App\Site;
use Tests\TestCase;
use Mockery;

class HeadTagsBuilderTest extends TestCase
{
    private $page;
    private $language;

    private $canonicalTagBuilder;
    private $alternateTagBuilder;
    private $langTagBuilder;
    private $tagsBuilders;

    public function setUp(): void
    {
        parent::setUp();

        $this->page = Mockery::mock(Page::class);
        $this->language = Mockery::mock(Language::class);

        $this->canonicalTagBuilder = Mockery::mock(CanonicalTagBuilder::class)->makePartial();
        $this->canonicalTagBuilder->shouldReceive('create')
            ->andReturn([
                '<link rel="canonical" href="https://cdek-de.com/de">',
            ]);

        $this->alternateTagBuilder = Mockery::mock(AlternateTagBuilder::class)->makePartial();
        $this->alternateTagBuilder->shouldReceive('create')->once()->andReturn([
            '<link rel="alternate" hreflang="ru-RU" href="https://cdek-de.com/ru">',
            '<link rel="alternate" hreflang="de-DE" href="https://cdek-de.com/de">',
            '<link rel="alternate" hreflang="x-default" href="https://cdek-de.com/en">',
        ]);

        $this->langTagBuilder = Mockery::mock(LangTagBuilder::class)->makePartial();
        $this->langTagBuilder->shouldReceive('create')->once()->andReturn([
            '<html lang="EN_en">',
        ]);

        $this->tagsBuilders = new HeadTagsBuilder(
            $this->canonicalTagBuilder,
            $this->alternateTagBuilder
        );
    }

    public function testGetTags()
    {
        $site = Mockery::mock(Site::class)->makePartial();
        $site->shouldReceive('getAttribute')->with('domain')->andReturn('cdek-de.com');
        $expected = [
            'lang' => [
                '<html lang="EN_en">',
            ],
            'canonical' => [
                '<link rel="canonical" href="https://cdek-de.com/de">',
            ],
            'alternate' => [
                '<link rel="alternate" hreflang="ru-RU" href="https://cdek-de.com/ru">',
                '<link rel="alternate" hreflang="de-DE" href="https://cdek-de.com/de">',
                '<link rel="alternate" hreflang="x-default" href="https://cdek-de.com/en">',
            ],
            'meta' => [
                '<meta name="yandex-verification" content="58db2ec13e1f05bf">',
                '<meta name="google-site-verification" content="FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk">'
            ]
        ];

        $result = $this->tagsBuilders->getTags($site, $this->page, $this->language);
        $this->assertEquals($expected, $result);
    }
}
