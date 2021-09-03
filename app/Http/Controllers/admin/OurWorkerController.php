<?php

namespace App\Http\Controllers\admin;

use App\Classes\FileUploader;
use App\Classes\OurWorkerRepository;
use App\Http\Controllers\Controller;
use App\OurWorker;
use App\OurWorkerText;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class OurWorkerController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
                [
                    'ourWorkers' => function ($query) {
                        $query->select('id', 'site_id', 'photo', 'sort')
                            ->orderBy('sort');
                    },
                    'ourWorkers.ourWorkerTexts' => function ($query) {
                        $query->select('id', 'our_worker_id', 'name', 'post');
                    },
                ]
            )
            ->find($request->input('site_id'));
        return view('admin.our_workers.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $ourWorker = OurWorker::select('id', 'photo', 'site_id')
                ->with(
                    [
                        'ourWorkerTexts' => function ($query) {
                            $query->select('id', 'our_worker_id', 'language_id', 'name', 'post');
                        },
                    ]
                )
                ->find($id);
            $siteId = $ourWorker->site_id;
        } else {
            $ourWorker = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($siteId);

        return view('admin.our_workers.form')
            ->with('site', $site)
            ->with('ourWorker', $ourWorker);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $ourWorker = OurWorker::find($request->input('id'));
        } else {
            $ourWorker = new OurWorker();
        }
        $ourWorker->site_id = $request->input('site_id');
        if (!$isEditMode) {
            $ourWorker->sort = OurWorker::where('site_id', $ourWorker->site_id)->max('sort') + self::SORT_STEP;
        }
        $ourWorker->save();
        FileUploader::to($ourWorker, 'photo')
            ->from($request, 'photo')
            ->setDisk('our_worker_photos')
            ->store();
        $ourWorker->save();

        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($ourWorker->site_id);

        $ourWorkerRepository = OurWorkerRepository::getInstance($ourWorker);
        foreach ($site->languages as $language) {
            $ourWorkerText = $ourWorkerRepository->getTextByLanguage($language->id);
            $ourWorkerText->name = $request->input('name')[$language->id] ?? '';
            $ourWorkerText->post = $request->input('post')[$language->id] ?? '';
            $ourWorkerText->save();
        }

        return response()->redirectToRoute('admin.our_workers.index', ['site_id' => $ourWorker->site_id]);
    }

    public function delete(Request $request)
    {
        $ourWorker = OurWorker::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $ourWorker->site_id;
        $ourWorker->delete();
        return response()->redirectToRoute('admin.our_workers.index', ['site_id' => $site_id]);
    }

    public function move(Request $request)
    {
        $ourWorker = OurWorker::select('id', 'site_id', 'sort')
            ->find($request->input('id'));

        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherOurWorker = OurWorker::select('id', 'sort')
            ->where('site_id', $ourWorker->site_id)
            ->where('sort', $sign, $ourWorker->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $ourWorker->sort;
        $ourWorker->sort = $otherOurWorker->sort;
        $ourWorker->save();
        $otherOurWorker->sort = $sort;
        $otherOurWorker->save();

        return response()->redirectToRoute('admin.our_workers.index', ['site_id' => $ourWorker->site_id]);
    }

}
