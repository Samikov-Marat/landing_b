<?php


namespace App\Classes;


use App\HistoryCategory;

class HistoryCategoryRepository
{

    /**
     * @return static
     */
    public static function getInstance()
    {
        return new static();
    }

    public function getLastHistoryCategories($localOffices)
    {
        return HistoryCategory::whereIn('local_office_id', $localOffices->pluck('id'))
            ->where('by_turns', 1)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function saveForHistory($localOffice)
    {
        $historyCategory = new HistoryCategory();
        $historyCategory->local_office_id = $localOffice->id;
        $historyCategory->by_turns = true;
        $historyCategory->save();
    }

}
