<?php


namespace App\Classes;


use App\LocalOffice;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocalOfficeRepository
{

    var $localOffice;

    public static function getInstance(LocalOffice $localOffice)
    {
        return new static($localOffice);
    }

    public function __construct($localOffice)
    {
        $this->localOffice = $localOffice;
    }


    public function getTextByLanguage($language_id)
    {
        try {
            return $this->localOffice->localOfficeTexts()
                ->select(
                    'id',
                    'local_office_id',
                    'language_id',
                    'name',
                    'address',
                    'path'
                )
                ->where('language_id', $language_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->localOffice->localOfficeTexts()
                ->make()->setAttribute('language_id', $language_id);
        }
    }
}
