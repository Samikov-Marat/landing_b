<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\Tags\AlternateTagBuilder;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlternateTagBuilderTest extends TestCase
{
    public function testCreateWithIndexPage()
    {
        $site = factory(Site::class)->make();
        $site->languages = collect([
            factory(Language::class)->make([
                'shortname' => 'RU'
            ]),
            factory(Language::class)->make([
                'shortname' => 'EN'
            ]),
            factory(Language::class)->make([
                'shortname' => 'ES'
            ])
        ]);

        $page = factory(Page::class)->make([
            'url' => '/',
        ]);
        $language = $site->languages->first();


        $alternateTagBuilder = new AlternateTagBuilder();
        $result = $alternateTagBuilder->create($site, $page, $language);

        $expected = [
            '<link rel=alternate href=https://landing.local/ru hreflang=x-default>',
            '<link rel=alternate href=https://landing.local/en hreflang=EN>',
            '<link rel=alternate href=https://landing.local/es hreflang=ES>',
        ];
        $this->assertEquals($expected, $result);
    }
}
