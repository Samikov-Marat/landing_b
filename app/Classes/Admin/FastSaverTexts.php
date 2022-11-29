<?php

namespace App\Classes\Admin;

use App\Text;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FastSaverTexts implements FastSaver
{
    private $text_type_id;

    public function __construct($text_type_id)
    {
        $this->text_type_id = $text_type_id;
    }

    public function save($value, $language)
    {
        try {
            $text = Text::select(['id',])
                ->where('text_type_id', $this->text_type_id)
                ->where('language_id', $language->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $text = new Text();
            $text->text_type_id = $this->text_type_id;
            $text->language_id = $language->id;
        }
        $text->value = $value;
        $text->save();
    }
}
