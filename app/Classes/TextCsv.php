<?php


namespace App\Classes;


class TextCsv
{
    var $streamName = '';
    var $stream = null;
    var $streamRead = null;

    const DELIMITER = ';';

    const MESSAGE_1 = 'Первые две строки менять нельзя';
    const MESSAGE_2 = 'Первый столбец менять нельзя';
    const PAGE_PREFIX = 'страница ';

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

    private function put($strings){
        $length = fputcsv($this->stream, $strings, static::DELIMITER);
    }

    private static function getPagePrefix($page){
        return static::PAGE_PREFIX . $page->name;
    }

    public function start($site)
    {
        $this->openStream();
        $csvHeader = [static::MESSAGE_1];
        foreach ($site->languages as $language){
            $csvHeader[] = $language->id;
        }
        $this->put($csvHeader);

        $csvHeader2 = [static::MESSAGE_2];
        foreach ($site->languages as $language){
            $csvHeader2[] = $language->name;
        }
        $this->put($csvHeader2);

        foreach ($site->pages as $page){
            $pageHeader = [static::getPagePrefix($page),];
            foreach ($site->languages as $language){
                $pageHeader[] = '';
            }
            $this->put($pageHeader);

            foreach ($page->textTypes as $textType){
                $line = [$textType->id, ];
                $textsByLanguage = $textType->texts->keyBy('language_id');
                foreach($site->languages as $language){
                    if($textsByLanguage->has($language->id)){
                        $line[] = $textsByLanguage->get($language->id)->value;
                    }
                    else{
                        $line[] = '';
                    }
                }
                $this->put($line);
            }
        }
        $this->closeStream();
    }
}
