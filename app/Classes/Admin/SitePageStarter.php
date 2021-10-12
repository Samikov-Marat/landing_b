<?php

namespace App\Classes\Admin;

use App\Classes\TextTypeStarter;

class SitePageStarter
{
    var $languageIds;

    public function __construct($languages)
    {
        $this->languageIds = $languages->pluck('id');
    }

    public static function getInstance($languages): self
    {
        return new static($languages);
    }

    public function createTextsForPages($pages)
    {
        foreach ($pages as $page) {
            foreach ($page->textTypes as $textType) {
                $existedLanguageIds = $textType->texts->pluck('language_id');
                $onlyAppendedLanguageIds = $this->languageIds->diff($existedLanguageIds);
                TextTypeStarter::getInstance($textType)
                    ->createTextForLanguages($onlyAppendedLanguageIds);
            }
        }
    }
}
