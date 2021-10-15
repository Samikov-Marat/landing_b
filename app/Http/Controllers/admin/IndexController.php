<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\LocalOffice;
use App\Site;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $columns = [
            'innerKey' => LocalOffice::newModelInstance()->qualifyColumn('site_id'),
            'outerKey' => Site::newModelInstance()->qualifyColumn('id'),
            'category' => LocalOffice::newModelInstance()->qualifyColumn('category'),
        ];

        $localOfficeExistsQuery = LocalOffice::selectRaw('1')
            ->whereColumn($columns['innerKey'], '=', $columns['outerKey'])
            ->getQuery();

        $localOfficeHaveEmptyCategoryQuery = LocalOffice::selectRaw('1')
            ->whereColumn($columns['innerKey'], '=', $columns['outerKey'])
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

        $siteCertification = Site::select(['id', 'name', 'domain'])
            ->with('certificateChecks')
            ->get();
        $now = new Carbon('now');
        $inAMonth = new Carbon('+1 month');

        return view('admin.index')
            ->with('problems', $problems)
            ->with('siteCertification', $siteCertification)
            ->with('now', $now)
            ->with('inAMonth', $inAMonth);
    }
}
