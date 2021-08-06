<?php

namespace App\Classes;

class LanguageDetector
{
    var $header = '';
    var $rating;

    public function __construct()
    {
        $this->header = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $this->rating = $this->getRating();
    }

    public function getRating()
    {
        $blocks = explode(',', $this->header);
        $weightLanguages = collect();
        foreach ($blocks as $block) {
            preg_match_all('#^(?P<language>\\w{2})(-([\\w\\d]*))*(;q=(?P<weight>.*))*#us', $block, $m);
            $weightLanguages->push(
                [
                    'language' => $m['language'][0],
                    'weight' => is_numeric($m['weight'][0]) ? (float)$m['weight'][0] : 1.0
                ]
            );
        }
        return $weightLanguages->sortByDesc('weight')
            ->values()
            ->pluck('language');
    }
}
