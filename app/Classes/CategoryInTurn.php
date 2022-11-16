<?php

namespace App\Classes;

class CategoryInTurn
{
    var $localOffices;

    public function __construct($localOffices)
    {
        $this->localOffices = $localOffices;
    }

    public static function getInstance($localOffices)
    {
        return new static($localOffices);
    }

    public function getNextNew()
    {
        $localOffice = $this->getNextLocalOffice();
        HistoryCategoryRepository::getInstance()->saveForHistory($localOffice);
        return $localOffice;
    }

    private function getNextLocalOffice()
    {
        if ($this->localOffices->isEmpty()) {
            throw new Exception('Нет офисов. Должна быть выбрана категория по-умолчанию.');
        }
        if ($this->localOffices->count() == 1) {
            return $this->localOffices[0];
        }
        $historyCategories = HistoryCategoryRepository::getInstance()
            ->getLastHistoryCategories($this->localOffices);
        if ($historyCategories->isEmpty()) {
            return $this->localOffices[0];
        }
        $lastHistoryCategory = $historyCategories[0];
        foreach ($this->localOffices as $k => $localOffice) {
            if ($lastHistoryCategory->local_office_id == $localOffice->id) {
                $nextKey = ($k + 1) % $this->localOffices->count();
                return $this->localOffices[$nextKey];
            }
        }
        Log::debug('Неизвестный utm в cookies');
        return $this->localOffices[0];
    }

}
