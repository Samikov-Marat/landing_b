<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\LocalOffice;
use App\Site;

class IndexController extends Controller
{
    public function index()
    {
        $columns = [
            'innerKey' => LocalOffice::newModelInstance()->qualifyColumn('site_id'),
            'outterKey' => Site::newModelInstance()->qualifyColumn('id'),
            'category' => LocalOffice::newModelInstance()->qualifyColumn('category'),
        ];

        $localOfficeExistsQuery = LocalOffice::selectRaw('1')
            ->whereColumn($columns['innerKey'], '=', $columns['outterKey'])
            ->getQuery();

        $localOfficeHaveEmptyCategoryQuery = LocalOffice::selectRaw('1')
            ->whereColumn($columns['innerKey'], '=', $columns['outterKey'])
            ->where($columns['category'], '')
            ->getQuery();

        $problems = [];

        $problems['absentOffice'] = Site::select(['id', 'name', 'domain'])
            ->addWhereExistsQuery($localOfficeExistsQuery, ' and', true)
            ->get();

        $problems['absentOfficeCategory'] = Site::select(['id', 'name', 'domain'])
            ->addWhereExistsQuery($localOfficeHaveEmptyCategoryQuery)
            ->with([
                       'localOffices' => function ($q) {
                           $q->where('category', '');
                       }
                   ])
            ->get();


        return view('admin.index')
            ->with('problems', $problems);
    }
}
