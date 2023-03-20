<?php


namespace App\Classes;


use App\LocalOffice;
use App\LocalOfficeEmail;
use App\LocalOfficePhone;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocalOfficeRepository
{
    const SORT_STEP = 10;
    private $localOffice;

    public static function getInstance(LocalOffice $localOffice): self
    {
        return new static($localOffice);
    }

    public function __construct(LocalOffice $localOffice)
    {
        $this->localOffice = $localOffice;
    }

    public function getOrMake($language_id)
    {
        try {
            return $this->localOffice->localOfficeTexts()
                ->select([
                             'id',
                             'local_office_id',
                             'language_id',
                             'name',
                             'address',
                             'path',
                         ])
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

    public function makePhone(): LocalOfficePhone
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

    public function deleteOtherPhones($ids)
    {
        $this->localOffice->localOfficePhones()
            ->whereNotIn('id', $ids)
            ->delete();
    }


    public function getEmail($id)
    {
        return $this->localOffice->localOfficeEmails()
            ->find($id);
    }

    public function makeEmail(): LocalOfficeEmail
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

    public function deleteOtherEmails($ids)
    {
        $this->localOffice->localOfficeEmails()
            ->whereNotIn('id', $ids)
            ->delete();
    }

}
