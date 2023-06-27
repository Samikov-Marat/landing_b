<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\Tags\CanonicalTagBuilder;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanonicalTagBuilderTest extends TestCase
{
    public function testCreateWithTag()
    {
        $site = factory(Site::class)->make([
            'domain' => 'cdek-de.com',
        ]);
        $page = factory(Page::class)->make();
        $language = \Mockery::mock(Language::class);

        $canonicalTagBuilder = new CanonicalTagBuilder();
        $result = $canonicalTagBuilder->create($site, $page, $language);
        $expected = [
            '<link rel=canonical href=https://landing.local/de>',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testCreateWithoutTag()
    {
        $site = factory(Site::class)->make();
        $page = factory(Page::class)->make();
        $language = \Mockery::mock(Language::class);

        $canonicalTagBuilder = new CanonicalTagBuilder();
        $result = $canonicalTagBuilder->create($site, $page, $language);
        $expected = [];

        $this->assertEquals($expected, $result);
    }
}
