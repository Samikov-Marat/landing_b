<?php

namespace App\Http\Controllers\Admin;

use App\CertificateChecks;
use App\Classes\Admin\ProblemCollector;
use App\Http\Controllers\Controller;
use App\Site;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $site = new Site();
        $certificateCheck = new CertificateChecks();
        $siteCertification = Site::select(['id', 'name', 'domain'])
            ->join($certificateCheck->getTable(), $site->qualifyColumn('id'), $certificateCheck->qualifyColumn('site_id'))
            ->with('certificateChecks')
            ->orderBy($certificateCheck->qualifyColumn('valid_to'))
            ->get();
        $now = new Carbon('now');
        $tooClose = new Carbon('+1 week');

        return view('admin.index')
            ->with('problems', ProblemCollector::getInstance()->getProblems())
            ->with('siteCertification', $siteCertification)
            ->with('now', $now)
            ->with('tooClose', $tooClose);
    }
}
