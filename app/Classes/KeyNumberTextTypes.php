<?php

namespace App\Classes;

use App\TextType;

class KeyNumberTextTypes
{
    public static function prepare()
    {
        $newTypes = [
            ['why_trusty_text2_prefix', 8, 161, 'Слово (знак, фраза) перед цифрой (отдельно от начала предложения, чтобы выделить жирным)'],
            ['why_available_text2_prefix', 8, 191, 'Слово (знак, фраза) перед цифрой (отдельно от начала предложения, чтобы выделить жирным)'],
            ['receive_office_count_prefix', 9, 779, 'Слово перед цифрой'],
            ['receive_country_count_prefix', 9, 789, 'Слово перед цифрой'],
            ['solution_number_1_prefix', 9, 289, 'Слово перед цифрой'],
            ['solution_number_2_prefix', 9, 309, 'Слово перед цифрой'],
            ['solution_number_3_prefix', 9, 329, 'Слово перед цифрой'],
            ['tariff_slider_text_1_prefix', 9, 139, 'Начало предложения'],
            ['faq_shop_answer_2_prefix', 15, 859, 'Начало предложения'],
            ['faq_shop_answer_2a_prefix', 15, 861, 'Начало предложения'],
            ['faq_shop_answer_2a', 15, 862, 'Конец предложения'],
        ];


        foreach ($newTypes as $newType) {
            $alreadyExists = TextType::select('*')
                ->where('shortname', $newType[0])
                ->where('page_id', $newType[2])
                ->exists();
            if (!$alreadyExists) {
                $textType = new TextType();
                $textType->shortname = $newType[0];
                $textType->page_id = $newType[1];
                $textType->sort = $newType[2];
                $textType->name = $newType[3];
                $textType->default_value = '';
                $textType->save();
                TextTypeStarter::getInstance($textType)
                    ->createTextForAllSites();
            }
        }

    }
}
