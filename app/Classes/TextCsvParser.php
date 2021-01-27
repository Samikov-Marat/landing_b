<?php


namespace App\Classes;


use App\Site;
use App\Text;
use Illuminate\Support\Facades\Storage;

class TextCsvParser
{
    var $site = null;
    var $languages = null;
    var $handle = null;

    const DELIMITER = ',';

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
        } catch (\Exception $e) {
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
                throw new \Exception('Идентификатор этого языка не относится к этому сайту');
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
            if ($this->isPageHeader($line)) {
                continue;
            }
            $this->loadTexts($line);
        }
    }

    public function loadTexts($line)
    {
        $text_type_id = array_shift($line);
        foreach ($this->languages as $language) {
            if (empty($line)) {
                throw new \Exception('Недостаточно данных');
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

    public function isPageHeader($line)
    {
        return !is_numeric($line[0]);
    }

    public function parseLine()
    {
        return fgetcsv($this->handle, 0, static::DELIMITER);;
    }
}
