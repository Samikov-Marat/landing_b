<?php

namespace App\Classes;

use App\LocalOfficeText;
use App\NewsArticleText;
use App\Site;
use App\SupportCategoryText;
use App\SupportQuestionText;
use App\Text;
use Exception;
use Illuminate\Support\Facades\Storage;

class TextCsvParser
{
    var $site = null;
    var $languages = null;
    var $handle = null;

    const DELIMITER = ',';

    const REGULAR = '#^(?<table>\w+)\.(?<id>\d+)\.(?<attribute>\w+)#u';

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function parse($path)
    {
        $fullPath = Storage::disk('local')->path($path);
        $this->handle = fopen($fullPath, 'r');
        try {
            $this->loadLanguages();
        } catch (Exception $e) {
            fclose($this->handle);
            throw $e;
        }
        $this->skipLine();

        $this->loadAllTexts();

        fclose($this->handle);
    }

    public function loadLanguages()
    {
        $line = $this->parseLine();
        array_shift($line);
        $this->checkLanguages($line);
        $this->languages = $line;
    }

    public function checkLanguages($languages)
    {
        $siteLanguages = $this->site->languages->pluck('id');
        foreach ($languages as $language) {
            if (!$siteLanguages->contains($language)) {
                throw new Exception('Идентификатор этого языка не относится к этому сайту');
            }
        }
    }

    public function skipLine()
    {
        $this->parseLine();
    }

    public function loadAllTexts()
    {
        while (!empty($line = $this->parseLine())) {
            if(is_numeric($line[0])){
                $this->loadTexts($line);
                continue;
            }
            if(preg_match(static::REGULAR, $line[0], $compositeId)){
                $this->loadSpecial($line, $compositeId);
            }
        }
    }

    public function loadTexts($line)
    {
        $text_type_id = array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new Exception('Недостаточно данных');
            }
            $value = array_shift($line);
            $text = Text::select('id', 'text_type_id', 'language_id', 'value')
                ->where('text_type_id', $text_type_id)
                ->where('language_id', $language)
                ->firstOrNew();
            $text->text_type_id = $text_type_id;
            $text->language_id = $language;
            $text->value = $value;
            $text->save();
        }
    }

    public function loadSpecial($line, $compositeId){
        if('office' == $compositeId['table']){
            $this->loadOfficeAttribute($compositeId['id'], $compositeId['attribute'], $line);
        }
        if('news' == $compositeId['table']){
            $this->loadNewsAttribute($compositeId['id'], $compositeId['attribute'], $line);
        }
        if('support_category' == $compositeId['table']){
            $this->loadSupportCategoryAttribute($compositeId['id'], $compositeId['attribute'], $line);
        }
        if('support_question' == $compositeId['table']){
            $this->loadSupportQuestionAttribute($compositeId['id'], $compositeId['attribute'], $line);
        }
    }

    public function loadOfficeAttribute($id, $attribute, $line){
        $dynamicAttributes = ['name', 'address', 'path', 'worktime'];
        if(!in_array($attribute, $dynamicAttributes)){
            throw new Exception('Это поле нельзя загрузить');
        }

        array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new Exception('Недостаточно данных');
            }
            $value = array_shift($line);

            $attributes = array_merge(['id', 'local_office_id', 'language_id'], $dynamicAttributes);
            $text = LocalOfficeText::select($attributes)
                ->where('local_office_id', $id)
                ->where('language_id', $language)
                ->firstOrNew();
            $text->local_office_id = $id;
            $text->language_id = $language;

            foreach ($dynamicAttributes as $dynamicAttribute) {
                if(is_null($text->getAttribute($dynamicAttribute))){
                    $text->setAttribute($dynamicAttribute, '');
                }
            }
            $text->setAttribute($attribute, $value);
            $text->save();
        }
    }

    public function loadNewsAttribute($id, $attribute, $line){
        $dynamicAttributes = ['header', 'note', 'text', 'publication_date_text'];
        if(!in_array($attribute, $dynamicAttributes)){
            throw new Exception('Это поле нельзя загрузить');
        }

        array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new Exception('Недостаточно данных');
            }
            $value = array_shift($line);

            $attributes = array_merge(['id', 'news_article_id', 'language_id'], $dynamicAttributes);
            $text = NewsArticleText::select($attributes)
                ->where('news_article_id', $id)
                ->where('language_id', $language)
                ->firstOrNew();
            $text->news_article_id = $id;
            $text->language_id = $language;

            foreach ($dynamicAttributes as $dynamicAttribute) {
                if(is_null($text->getAttribute($dynamicAttribute))){
                    $text->setAttribute($dynamicAttribute, '');
                }
            }
            $text->setAttribute($attribute, $value);
            $text->save();
        }
    }

    public function loadSupportCategoryAttribute($id, $attribute, $line){
        $dynamicAttributes = ['name'];
        if(!in_array($attribute, $dynamicAttributes)){
            throw new Exception('Это поле нельзя загрузить');
        }

        array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new Exception('Недостаточно данных');
            }
            $value = array_shift($line);

            $attributes = array_merge(['id', 'category_id', 'language_id'], $dynamicAttributes);
            $text = SupportCategoryText::select($attributes)
                ->where('category_id', $id)
                ->where('language_id', $language)
                ->firstOrNew();
            $text->category_id = $id;
            $text->language_id = $language;

            foreach ($dynamicAttributes as $dynamicAttribute) {
                if(is_null($text->getAttribute($dynamicAttribute))){
                    $text->setAttribute($dynamicAttribute, '');
                }
            }
            $text->setAttribute($attribute, $value);
            $text->save();
        }
    }

    public function loadSupportQuestionAttribute($id, $attribute, $line){
        $dynamicAttributes = ['question', 'answer'];
        if(!in_array($attribute, $dynamicAttributes)){
            throw new Exception('Это поле нельзя загрузить');
        }

        array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new Exception('Недостаточно данных');
            }
            $value = array_shift($line);

            $attributes = array_merge(['id', 'question_id', 'language_id'], $dynamicAttributes);
            $text = SupportQuestionText::select($attributes)
                ->where('question_id', $id)
                ->where('language_id', $language)
                ->firstOrNew();
            $text->question_id = $id;
            $text->language_id = $language;

            foreach ($dynamicAttributes as $dynamicAttribute) {
                if(is_null($text->getAttribute($dynamicAttribute))){
                    $text->setAttribute($dynamicAttribute, '');
                }
            }
            $text->setAttribute($attribute, $value);
            $text->save();
        }
    }


    public function parseLine()
    {
        return fgetcsv($this->handle, 0, static::DELIMITER);
    }
}
