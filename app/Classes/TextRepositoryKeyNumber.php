<?php

namespace App\Classes;

use App\Site;

class TextRepositoryKeyNumber
{
    const TEXT_TYPES_KEY_NUMBERS = [
        'why_trusty_text1', 'why_trusty_text2_prefix', 'why_trusty_text2', 'why_available_text1', 'why_available_text2_prefix', 'why_available_text2', 'receive_office_count_prefix', 'receive_office_count', 'receive_country_count_prefix', 'receive_country_count', 'solution_number_1_prefix', 'solution_number_1', 'solution_text_1', 'solution_number_2_prefix', 'solution_number_2', 'solution_text_2', 'solution_number_3_prefix', 'solution_number_3', 'solution_text_3', 'tariff_slider_text_1_prefix', 'tariff_slider_text_1', 'faq_shop_answer_2_prefix', 'faq_shop_answer_2', 'faq_shop_answer_2a_prefix', 'faq_shop_answer_2a',
    ];


    public static function getSite($site_id)
    {
        $textTypesKeyNumbers = self::TEXT_TYPES_KEY_NUMBERS;
        return Site::select('id', 'name')
            ->with(
                [
                    'pages.textTypes.texts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'value');
                    }
                ]
            )
            ->with(
                [
                    'pages.textTypes' => function ($query) use ($textTypesKeyNumbers) {
                        $query->select('id', 'page_id', 'shortname', 'name')
                            ->whereIn('shortname', $textTypesKeyNumbers)
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'pages' => function ($query) {
                        $query->select('id', 'site_id', 'name', 'url')
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->find($site_id);
    }
}
