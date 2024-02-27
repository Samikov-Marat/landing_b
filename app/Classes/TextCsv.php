<?php


namespace App\Classes;


class TextCsv
{
    public $streamName = '';
    public $filter = [];
    public $onlyPages = false;
    private $stream = null;

    const DELIMITER = ',';

    const MESSAGE_1 = 'Первые две строки менять нельзя';
    const MESSAGE_2 = 'Первый столбец менять нельзя';
    const PAGE_PREFIX = 'страница ';
    const PREFIX_OFFICE = 'офис ';
    const PREFIX_SUPPORT_CATEGORY = 'категория ';
    const PREFIX_SUPPORT_QUESTION = 'вопрос ';
    const PREFIX_NEWS_ARTICLE = 'новость ';


    public function __construct()
    {
        $this->streamName = 'php://output';
        $this->filter = [];
        $this->onlyPages = false;
    }

    private function openStream()
    {
        $this->stream = fopen($this->streamName, 'w');
    }

    private function closeStream()
    {
        fclose($this->stream);
    }

    private function put($strings)
    {
        $length = fputcsv($this->stream, $strings, static::DELIMITER);
    }

    private static function getPagePrefix($page)
    {
        return static::PAGE_PREFIX . $page->name;
    }

    private static function getOfficePrefix($page)
    {
        return static::PREFIX_OFFICE . $page->code;
    }

    private static function getSupportCategoryPrefix($category)
    {
        return static::PREFIX_SUPPORT_CATEGORY . $category->id;
    }

    private static function getSupportQuestionPrefix($question)
    {
        return static::PREFIX_SUPPORT_QUESTION . $question->id;
    }

    private static function getNewsArticlePrefix($newsArticle)
    {
        return static::PREFIX_NEWS_ARTICLE . $newsArticle->id;
    }

    public function start($site)
    {
        $this->openStream();
        $csvHeader = [static::MESSAGE_1];
        foreach ($site->languages as $language) {
            $csvHeader[] = $language->id;
        }
        $this->put($csvHeader);

        $csvHeader2 = [static::MESSAGE_2];
        foreach ($site->languages as $language) {
            $csvHeader2[] = $language->name;
        }
        $this->put($csvHeader2);

        foreach ($site->pages as $page) {
            $pageHeader = [static::getPagePrefix($page),];
            foreach ($site->languages as $language) {
                $pageHeader[] = '';
            }
            $this->put($pageHeader);

            foreach ($page->textTypes as $textType) {
                $line = [$textType->id,];
                $textsByLanguage = $textType->texts->keyBy('language_id');
                foreach ($site->languages as $language) {
                    if ($textsByLanguage->has($language->id)) {
                        $line[] = $textsByLanguage->get($language->id)->value;
                    } else {
                        $line[] = '';
                    }
                }
                $this->put($line);
            }
        }

        if($this->onlyPages){
            $this->closeStream();
            return;
        }

        foreach ($site->localOffices as $office) {
            $officeHeader = [static::getOfficePrefix($office),];
            foreach ($site->languages as $language) {
                $officeHeader[] = '';
            }
            $this->put($officeHeader);

            $textsByLanguage = $office->localOfficeTexts->keyBy('language_id');
            foreach (['name', 'address', 'path', 'worktime'] as $attribute) {
                $line = $this->getLocalOfficeTextAttribute($site, $office, $textsByLanguage, $attribute);
                $this->put($line);
            }
        }
        foreach ($site->supportCategories as $category) {
            $categoryHeader = [static::getSupportCategoryPrefix($category),];
            foreach ($site->languages as $language) {
                $categoryHeader[] = '';
            }
            $this->put($categoryHeader);

            $textsByLanguage = $category->supportCategoryTexts->keyBy('language_id');
            foreach (['name',] as $attribute) {
                $line = $this->getSupportCategoiesTextAttribute($site, $category, $textsByLanguage, $attribute);
                $this->put($line);
            }
        }

        foreach ($site->supportCategories as $category) {
            foreach ($category->supportQuestions as $question){
                $questionHeader = [static::getSupportQuestionPrefix($question),];
                foreach ($site->languages as $language) {
                    $questionHeader[] = '';
                }
                $this->put($questionHeader);

                $textsByLanguage = $question->supportQuestionTexts->keyBy('language_id');
                foreach (['question', 'answer',] as $attribute) {
                    $line = $this->getSupportQuestionTextAttribute($site, $question, $textsByLanguage, $attribute);
                    $this->put($line);
                }
            }
        }

        foreach ($site->newsArticles as $newsArticle) {
            $newsArticleHeader = static::getModuleHeaderLine(static::getNewsArticlePrefix($newsArticle), $site->languages);
            $this->put($newsArticleHeader);

            $textsByLanguage = $newsArticle->newsArticleTexts->keyBy('language_id');
            foreach (['header', 'note', 'text', 'publication_date_text'] as $attribute) {
                $line = $this->getNewsArticleTextAttribute($site, $newsArticle, $textsByLanguage, $attribute);
                $this->put($line);
            }
        }
        $this->closeStream();
    }

    private static function getModuleHeaderLine($name, $languages):array
    {
        return array_merge(
            [$name,],
            array_fill(1, $languages->count(), '')
        );
    }

    public function getLocalOfficeTextAttribute($site, $office, $textsByLanguage, $attribute)
    {
        $superId = implode('.', ['office', $office->id, $attribute]);
        $line = [$superId,];
        foreach ($site->languages as $language) {
            if ($textsByLanguage->has($language->id)) {
                $line[] = $textsByLanguage->get($language->id)->getAttribute($attribute);
            } else {
                $line[] = '';
            }
        }
        return $line;
    }
    public function getSupportCategoiesTextAttribute($site, $category, $textsByLanguage, $attribute)
    {
        $superId = implode('.', ['support_category', $category->id, $attribute]);
        $line = [$superId,];
        foreach ($site->languages as $language) {
            if ($textsByLanguage->has($language->id)) {
                $line[] = $textsByLanguage->get($language->id)->getAttribute($attribute);
            } else {
                $line[] = '';
            }
        }
        return $line;
    }

    public function getSupportQuestionTextAttribute($site, $question, $textsByLanguage, $attribute)
    {
        $superId = implode('.', ['support_question', $question->id, $attribute]);
        $line = [$superId,];
        foreach ($site->languages as $language) {
            if ($textsByLanguage->has($language->id)) {
                $line[] = $textsByLanguage->get($language->id)->getAttribute($attribute);
            } else {
                $line[] = '';
            }
        }
        return $line;
    }

    public function getNewsArticleTextAttribute($site, $newsArticle, $textsByLanguage, $attribute)
    {
        $superId = implode('.', ['news', $newsArticle->id, $attribute]);
        $line = [$superId,];
        foreach ($site->languages as $language) {
            if ($textsByLanguage->has($language->id)) {
                $line[] = $textsByLanguage->get($language->id)->getAttribute($attribute);
            } else {
                $line[] = '';
            }
        }
        return $line;
    }

}
