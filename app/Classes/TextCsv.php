<?php


namespace App\Classes;


class TextCsv
{
    var $streamName = '';
    var $stream = null;
    var $streamRead = null;

    const DELIMITER = ',';

    const MESSAGE_1 = 'Первые две строки менять нельзя';
    const MESSAGE_2 = 'Первый столбец менять нельзя';
    const PAGE_PREFIX = 'страница ';
    const PREFIX_OFFICE = 'офис ';
    const PREFIX_NEWS_ARTICLE = 'новость ';


    public function __construct()
    {
        $this->streamName = 'php://output';
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
