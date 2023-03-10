<?php

namespace App\Classes;

use App\LocalOffice;
use App\Site;

class CategoryInTurn
{
    private $localOffices;

    public function __construct(Site $site)
    {
        if ($site->equal_request_distribution) {
            $this->localOffices = $site->localOffices->unique('category')->values();
        } else {
            $this->localOffices = $site->localOffices->values();
        }
    }

    public static function getInstance($site): self
    {
        return new static($site);
    }

    public function getNextNew(): LocalOffice
    {
        $localOffice = $this->getNextLocalOffice();
        HistoryCategoryRepository::getInstance()->saveForHistory($localOffice);
        return $localOffice;
    }

    private function getNextLocalOffice(): LocalOffice
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
