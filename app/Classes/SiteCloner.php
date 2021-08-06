<?php


namespace App\Classes;


use App\Language;
use App\Site;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteCloner
{
    var $site_id;
    var $language_id;

    var $newDomain;
    var $newName;

    public static function getInstance()
    {
        return new static;
    }

    public function setSite($site_id)
    {
        $this->site_id = $site_id;
        return $this;
    }

    public function setLanguage($language_id)
    {
        $this->language_id = $language_id;
        return $this;
    }

    public function setNewDomain($newDomain)
    {
        $this->newDomain = $newDomain;
        return $this;
    }

    public function setNewName($newName)
    {
        $this->newName = $newName;
        return $this;
    }


    public function makeClone()
    {
        $oldSite = Site::find($this->site_id);
        $newSite = $oldSite->replicate()
            ->setAttribute('domain', $this->newDomain)
            ->setAttribute('name', $this->newName);
        $newSite->save();

        $oldLanguage = Language::find($this->language_id);
        $newLanguage = $oldLanguage->replicate()
            ->setAttribute('site_id', $newSite->id);
        $newLanguage->save();

        $oldSite->load('pages');
        $oldPages = $oldSite->pages;
        foreach ($oldPages as $oldPage) {
            $newSite->pages()->attach($oldPage->id);
            $this->cloneText($oldPage, $oldLanguage, $newLanguage);
        }

        $oldSite->load('images');
        $oldImages = $oldSite->images;
        foreach ($oldImages as $oldImage) {
            $newImage = $oldImage->replicate();
            $newImage->setAttribute('site_id', $newSite->id);

            $newPath = 'images/' . $newImage->page_id . '/' . Str::random(40);

            File::copy(
                Storage::disk('public')->path($oldImage->path),
                Storage::disk('public')->path($newPath)
            );
            $newImage->setAttribute('path', $newPath);
            $newImage->save();
        }
    }

    private function cloneText($oldPage, $oldLanguage, $newLanguage)
    {
        $oldPage->load(
            [
                'textTypes.texts' => function ($query) use ($oldLanguage) {
                    $query->where('language_id', $oldLanguage->id);
                }
            ]
        );
        foreach ($oldPage->textTypes as $textType) {
            if ($textType->texts->isEmpty()) {
                throw new \Exception('Нет текста Страница ' . $oldPage->id . ' Язык ' . $oldLanguage->id);
            }
            $textType->texts[0]->replicate()
                ->setAttribute('language_id', $newLanguage->id)
                ->save();
        }
    }


}
