<?php

namespace Tests\Unit;

use App\Classes\LanguageDetector;
use App\Language;
use PHPUnit\Framework\TestCase;

class LanguageDetectorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetRating()
    {
        $httpAcceptLanguage = 'ru-RU';
        $expected = collect(['ru']);
        $rating = LanguageDetector::getInstance($httpAcceptLanguage)->getRating();
        $this->assertTrue($rating->diff($expected)->isEmpty());
    }


    public function testGetRating2()
    {
        $testSet = [
            [
                'httpAcceptLanguage' => 'de',
                'expected' => ['de'],
            ],
            [
                'httpAcceptLanguage' => 'de-CH',
                'expected' => ['de'],
            ],
            [
                'httpAcceptLanguage' => 'en-US,en;q=0.5',
                'expected' => ['en', 'en'],
            ],
            [
                'httpAcceptLanguage' => 'fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5',
                'expected' => ['fr', 'fr', 'en', 'de'],
            ],
            [
                'httpAcceptLanguage' => 'ru-RU, ru;q=0.9, en-US;q=0.8, en;q=0.7, fr;q=0.6',
                'expected' => ['ru', 'ru', 'en', 'en', 'fr'],
            ],
        ];

        foreach ($testSet as $pair) {
            $rating = LanguageDetector::getInstance($pair['httpAcceptLanguage'])->getRating();
            $this->assertTrue($rating->diff(collect($pair['expected']))->isEmpty());
        }
    }

    public function testChooseFrom()
    {
        $httpAcceptLanguage = 'ru-RU, ru;q=0.9, en-US;q=0.8, en;q=0.7, fr;q=0.6';

        $ru = new Language();
        $ru->language_code_iso = 'ru';

        $en = new Language();
        $en->language_code_iso = 'en';

        $fr = new Language();
        $fr->language_code_iso = 'fr';

        $bg = new Language();
        $bg->language_code_iso = 'bg';

        $testSet = [
            [
                'languages' => collect([$ru, $en, $fr]),
                'expected' => 'ru',
                'message' => 'Максимальный приоритет из 3',
            ],
            [
                'languages' => collect([$en, $fr]),
                'expected' => 'en',
                'message' => 'Не максимальный приоритет из 2',
            ],
            [
                'languages' => collect([$en, $ru]),
                'expected' => 'ru',
                'message' => 'Максимальный приоритет при смешанном списке',
            ],
            [
                'languages' => collect([$fr]),
                'expected' => 'fr',
                'message' => 'Единственный вариант',
            ],
            [
                'languages' => collect([$bg]),
                'expected' => 'bg',
                'message' => 'Единственный вариант, даже не входящий в список желательных',
            ],
        ];

        foreach ($testSet as $pair) {
            $chosenLanguage = LanguageDetector::getInstance($httpAcceptLanguage)
                ->chooseFrom($pair['languages']);
            $this->assertTrue($chosenLanguage->language_code_iso == $pair['expected'], $pair['message']);
        }
    }

}
