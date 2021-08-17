<?php

namespace App\Classes;

use App\Exceptions\LanguageDetector\LanguagesIsEmpty;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class LanguageDetector
{
    var $header = '';

    public function __construct($httpAcceptLanguage)
    {
        $this->header = $httpAcceptLanguage;
    }

    public static function getInstance($httpAcceptLanguage)
    {
        return new static($httpAcceptLanguage);
    }

    public function chooseFrom(Collection $languages)
    {
        if ($languages->isEmpty()){
            throw new LanguagesIsEmpty();
        }
        if($languages->count() == 1){
            return $languages->first();
        }
        $wishfulLanguages = $this->getRating();
        foreach ($wishfulLanguages as $wishfulLanguage) {
            foreach ($languages as $language) {
                if ($language->language_code_iso == $wishfulLanguage) {
                    return $language;
                }
            }
        }
        return $languages->first();
    }

    public function getRating(): Collection
    {
        $blocks = explode(',', $this->header);
        $weightLanguages = collect();
        foreach ($blocks as $block) {
            preg_match_all('#^(?P<language>\\w{2})(-([\\w\\d]*))*(;q=(?P<weight>.*))*#us', trim($block), $m);
            if (Arr::exists($m['language'], 0)) {
                $weightLanguages->push(
                    [
                        'language' => $m['language'][0],
                        'weight' => is_numeric($m['weight'][0]) ? (float)$m['weight'][0] : 1.0
                    ]
                );
            }
        }
        return $weightLanguages->sortByDesc('weight')
            ->values()
            ->pluck('language');
    }
}
