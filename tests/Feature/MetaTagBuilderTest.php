<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\Tags\MetaTagBuilder;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MetaTagBuilderTest extends TestCase
{
    public function testCreateTag()
    {
        $site = factory(Site::class)->make([
            'domain' => 'cdek-ge.com',
        ]);
        $page = \Mockery::mock(Page::class);
        $language = \Mockery::mock(Language::class);

        $metaTagBuilder = new MetaTagBuilder();
        $result = $metaTagBuilder->create($site, $page, $language);

        $expected = [
            '<meta name="yandex-verification" content="58db2ec13e1f05bf"/>',
            '<meta name="google-site-verification" content="FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk"/>',
        ];

        $this->assertEquals($expected, $result);
    }
}
