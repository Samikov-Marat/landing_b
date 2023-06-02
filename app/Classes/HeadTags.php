<?php

namespace App\Classes;

use App\Page;
use Illuminate\Support\Collection;

class HeadTags
{
    public function headParamsBuilder(Collection $fragments): array
    {
        $result = [];

        $canonicals = $fragments->firstWhere('name', 'canonicals');

        if (isset($canonicals)) {
            $result['canonicals'] = $this->getCanonicalsTagsParams($canonicals);
        }

        return $result;
    }

    private function getCanonicalsTagsParams(Page $page): Collection
    {
        $canonicalTexts = $page->getSpecificTextType('html_lang_tag')->texts()->get();

        return $canonicalTexts->mapWithKeys(function ($item) {
            return [$item['language_id'] => $item['value']];
        });
    }
}