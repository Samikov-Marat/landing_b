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
        $site = factory(Site::class)->make();
        $page = factory(Page::class)->make();
        $language = factory(Language::class)->make([
            'language_code_iso' => 'en'
        ]);

        $langTagBuilder = new LangTagBuilder();
        $result = $langTagBuilder->create($site, $page, $language);

        $expected = [
            '<html lang=en-EN>',
        ];

        $this->assertEquals($expected, $result);
    }
}
