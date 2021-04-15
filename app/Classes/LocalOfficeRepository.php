<?php


namespace App\Classes;


use App\LocalOffice;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocalOfficeRepository
{
    const SORT_STEP = 10;
    /**
     * @var LocalOffice
     */
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

    public function getPhone($id)
    {
        return $this->localOffice->localOfficePhones()
            ->find($id);
    }

    public function makePhone()
    {
        return $this->localOffice->localOfficePhones()
            ->make();
    }

    public function getNextPhoneSort()
    {
        try {
            return $this->localOffice->localOfficePhones()
                ->orderBy('sort', 'DESC')
                ->firstOrFail()
                ->sort + static::SORT_STEP;
        } catch (ModelNotFoundException $e) {
            return 0;
        }
    }

    public function deleteOtherPhones($ids){
        $this->localOffice->localOfficePhones()
            ->whereNotIn('id', $ids)
            ->delete();
    }


    public function getEmail($id)
    {
        return $this->localOffice->localOfficeEmails()
            ->find($id);
    }

    public function makeEmail()
    {
        return $this->localOffice->localOfficeEmails()
            ->make();
    }

    public function getNextEmailSort()
    {
        try {
            return $this->localOffice->localOfficeEmails()
                ->orderBy('sort', 'DESC')
                ->firstOrFail()
                ->sort + static::SORT_STEP;
        } catch (ModelNotFoundException $e) {
            return 0;
        }
    }

    public function deleteOtherEmails($ids){
        $this->localOffice->localOfficeEmails()
            ->whereNotIn('id', $ids)
            ->delete();
    }

}
