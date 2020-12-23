<?php


namespace App\Classes;


class FragmentRepository
{
    var $fragment;

    public function __construct($fragment)
    {
        $this->fragment = $fragment;
    }

    public function getWithTexts($language)
    {
        return $this->fragment->load(
            [
                'textTypes' => function ($query) {
                    $query->select('id', 'page_id', 'shortname');
                }
            ]
        )->load(
            [
                'textTypes.texts' => function ($query) use ($language) {
                    $query->select('id', 'text_type_id', 'value')
                        ->where('language_id', $language->id);
                }
            ]
        );
    }

}
