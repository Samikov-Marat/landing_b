<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\tags\AlternateTagBuilder;
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
        $site->languages = factory(Language::class, 3)->make();

        $page = factory(Page::class)->make([
            'url' => '/',
        ]);
        $language = $site->languages->first();


        $alternateTagBuilder = new AlternateTagBuilder();
        $result = $alternateTagBuilder->create($site, $page, $language);

        $expected = [
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[0]->shortname) . ' hreflang=x-default>',
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[1]->shortname) . ' hreflang=' . $site->languages[1]->shortname . '>',
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[2]->shortname) . ' hreflang=' . $site->languages[2]->shortname . '>',
        ];
        $this->assertEquals($expected, $result);
    }

    public function testCreateWithDocumentsPage()
    {
        $site = factory(Site::class)->make();
        $site->languages = factory(Language::class, 3)->make();

        $page = factory(Page::class)->make([
            'url' => 'documents',
        ]);
        $language = $site->languages->first();


        $alternateTagBuilder = new AlternateTagBuilder();
        $result = $alternateTagBuilder->create($site, $page, $language);

        $expected = [
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[0]->shortname) . '/documents hreflang=x-default>',
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[1]->shortname) . '/documents hreflang=' . $site->languages[1]->shortname . '>',
            '<link rel=alternate href=https://landing.local/' . \Str::lower($site->languages[2]->shortname) . '/documents hreflang=' . $site->languages[2]->shortname . '>',
        ];
        $this->assertEquals($expected, $result);
    }
}
