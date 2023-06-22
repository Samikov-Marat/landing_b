<?php

namespace App\Classes;

use App\Language;
use App\Page;
use Illuminate\Support\Collection;

class HeadTags
{
    public function headParamsBuilder(Collection $sitePages, Language $currentLanguage): array
    {
        $result = [];

        $canonicalPage = $sitePages->firstWhere('name', 'canonicals');

        if (isset($canonicalPage)) {
            $result['canonical'] = [
                'languageUri' => $this->getCanonicalLanguageUri($canonicalPage, $currentLanguage),
                'params' => $this->getCanonicalTagParams($canonicalPage)
            ];
        }
        return $result;
    }

    private function getCanonicalLanguageUri (Page $page, Language $language): string {
        return $page->getSpecificTextType('html_canonical_default_language')
            ->texts()
            ->firstWhere('language_id', $language->id)
            ->value;
    }

    private function getCanonicalTagParams(Page $page): Collection
    {
        $canonicalTexts = $page->getSpecificTextType('html_lang_tag')->texts()->get();

        return $canonicalTexts->mapWithKeys(function ($item) {
            return [$item['language_id'] => $item['value']];
        });
    }
}