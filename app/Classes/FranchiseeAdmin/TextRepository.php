<?php

namespace App\Classes\FranchiseeAdmin;

use App\Site;
use App\TextType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class TextRepository
{
    private $site;

    private $textTypeShortnames;

    public function __construct(Site $site)
    {
        $this->site = $site;

        $this->textTypeShortnames = [
            'delivery_from',
            'delivery_from_price',
            'delivery_list',
            'delivery_calculate',
            'delivery_header',
            'delivery_list',
            'delivery_button',
            'documents_onpagetext_1',
            'documents_onpagetext_2',
            'documents_onpagetext_3',
            'documents_onpagetext_4',
            'documents_onpagetext_5',
            'documents_onpagetext_6',
            'poster_header',
            'poster_list',
            'poster_button',

            'faq_shop_question_1',
            'faq_shop_answer_1',
            'faq_shop_question_2',
            'faq_shop_answer_2',
            'faq_shop_question_3',
            'faq_shop_answer_3',
            'faq_shop_question_4',
            'faq_shop_answer_4',
            'faq_shop_question_5',
            'faq_shop_answer_5',
            'faq_shop_question_6',
            'faq_shop_answer_6',
            'faq_shop_question_7',
            'faq_shop_answer_7',
            'faq_shop_question_8',
            'faq_shop_answer_8',
            'faq_shop_question_9',
            'faq_shop_answer_9',
            'faq_shop_question_10',
            'faq_shop_answer_10',
            'faq_shop_question_11',
            'faq_shop_answer_11',
            'faq_shop_question_12',
            'faq_shop_answer_12',
        ];
    }

    public static function getInstance(Site $site): self
    {
        return new static($site);
    }

    public function getPages($franchisee): Collection
    {
        $textTypeShortnames = $this->textTypeShortnames;

        $languageIds = $this->site->languages->pluck('id');

        return $this->site->pages()->whereHas('textTypes', function (Builder $query) use ($textTypeShortnames) {
            $query->whereIn('shortname', $textTypeShortnames);
        })->with([
                     'textTypes' => function ($query) use ($textTypeShortnames) {
                         $query->whereIn('shortname', $textTypeShortnames);
                     },
                     'textTypes.texts' => function ($query) use ($languageIds) {
                         $query->whereIn('language_id', $languageIds);
                     },
                     'textTypes.franchiseeTexts' => function ($query) use ($franchisee, $languageIds) {
                         $query->where('franchisee_id', $franchisee->id)
                             ->whereIn('language_id', $languageIds);
                     },
                 ])
            ->get();
    }


    public function getTextType($textTypeId, $franchisee): TextType
    {
        $textTypeShortnames = $this->textTypeShortnames;

        $languageIds = $this->site->languages->pluck('id');

        return TextType::select('id', 'page_id', 'shortname', 'name', 'default_value')
            ->with(
                [
                    'texts' => function ($query) use ($languageIds) {
                        $query->whereIn('language_id', $languageIds);
                    }
                ]
            )
            ->with([
                       'franchiseeTexts' => function ($query) use ($franchisee, $languageIds) {
                           $query->where('franchisee_id', $franchisee->id)
                               ->whereIn('language_id', $languageIds);;
                       },
                   ])
            ->whereIn('shortname', $textTypeShortnames)
            ->findOrFail($textTypeId);
    }
}
