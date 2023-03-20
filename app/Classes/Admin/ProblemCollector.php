<?php

namespace App\Classes\Admin;

use App\LocalOffice;
use App\Site;
use App\Text;
use Illuminate\Support\Facades\DB;

class ProblemCollector
{
    private $columns;

    public function __construct()
    {
    }

    public static function getInstance(): self
    {
        return new static();
    }

    public function getProblems()
    {
        $this->initColumns();

        $problems = [];
        $problems['absentOffice'] = $this->getSitesWithoutOffices();
        $problems['absentOfficeCategory'] = $this->getSitesWithOfficesWithoutCategories();
        $problems['textsDoubles'] = $this->getTextsDoubles();
        return $problems;
    }

    private function initColumns()
    {
        $this->columns = [
            'innerKey' => LocalOffice::newModelInstance()->qualifyColumn('site_id'),
            'outerKey' => Site::newModelInstance()->qualifyColumn('id'),
            'category' => LocalOffice::newModelInstance()->qualifyColumn('category'),
        ];
    }

    private function getSitesWithoutOffices()
    {
        $localOfficeExistsQuery = LocalOffice::selectRaw('1')
            ->whereColumn($this->columns['innerKey'], '=', $this->columns['outerKey'])
            ->getQuery();

        return Site::select(['id', 'name', 'domain'])
            ->addWhereExistsQuery($localOfficeExistsQuery, ' and', true)
            ->get();
    }

    private function getSitesWithOfficesWithoutCategories()
    {
        $localOfficeHaveEmptyCategoryQuery = LocalOffice::selectRaw('1')
            ->whereColumn($this->columns['innerKey'], '=', $this->columns['outerKey'])
            ->where($this->columns['category'], '')
            ->getQuery();

        return Site::select(['id', 'name', 'domain'])
            ->addWhereExistsQuery($localOfficeHaveEmptyCategoryQuery)
            ->with([
                       'localOffices' => function ($q) {
                           $q->where('category', '');
                       }
                   ])
            ->get();
    }

    private function getTextsDoubles()
    {
        return Text::select(['text_type_id', 'language_id', DB::raw('COUNT(*) as text_count')])
            ->groupBy(['text_type_id', 'language_id'])
            ->having('text_count', '>', 1)
            ->get();
    }

}
