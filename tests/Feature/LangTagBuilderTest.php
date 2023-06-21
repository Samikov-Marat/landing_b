<?php

namespace Tests\Feature;

use App\Classes\Site\HeadTags\tags\LangTagBuilder;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LangTagBuilderTest extends TestCase
{
    public function testCreate()
    {
        $site = \Mockery::mock(Site::class);
        $page = \Mockery::mock(Page::class);
        $language = factory(Language::class)->make();

        $langTagBuilder = new LangTagBuilder();
        $result = $langTagBuilder->create($site, $page, $language);

        $expected = [
            '<html lang=' . $language->language_code_iso . '-' . \Str::upper($language->language_code_iso) . '>',
        ];

        $this->assertEquals($expected, $result);
    }
}
