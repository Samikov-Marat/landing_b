<?php

namespace App\Http\Controllers\admin;

use App\Classes\FileUploader;
use App\Classes\LocalOfficePhotoDetector;
use App\Classes\LocalOfficePhotoIsoSearcher;
use App\Http\Controllers\Controller;
use App\LocalOfficePhoto;
use App\LocalOffice;
use App\Site;
use Illuminate\Http\Request;

class LocalOfficePhotoController extends Controller
{
    const SORT_STEP = 10;
    const FIElDS = [
        'id',
        'local_office_id',
        'sample',
        'sample2',
        'mobile',
        'mobile2',
        'tablet',
        'tablet2',
    ];

    public function index(Request $request)
    {
        $localOffice = LocalOffice::select('id', 'site_id', 'code')
            ->with(
                [
                    'localOfficePhotos' => function ($query) {
                        $query->select( self::FIElDS)
                            ->orderBy('sort');
                    },
                ]
            )
            ->find($request->input('local_office_id'));
        $site = Site::select('id', 'name', 'domain')->find($localOffice->site_id);
        return view('admin.local_office_photos.index')
            ->with('localOffice', $localOffice)
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $localOfficePhoto = LocalOfficePhoto::select(self::FIElDS)
                ->find($id);
            $localOfficeId = $localOfficePhoto->local_office_id;
        } else {
            $localOfficePhoto = null;
            $localOfficeId = $request->input('local_office_id');
        }
        $localOffice = LocalOffice::select('id', 'site_id', 'code')
            ->find($localOfficeId);
        $site = Site::select('id', 'name', 'domain')->find($localOffice->site_id);
        return view('admin.local_office_photos.form')
            ->with('localOffice', $localOffice)
            ->with('localOfficePhoto', $localOfficePhoto)
            ->with('site', $site);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $localOfficePhoto = LocalOfficePhoto::find($request->input('id'));
        } else {
            $localOfficePhoto = new LocalOfficePhoto();
        }

        $localOfficePhoto->local_office_id = $request->input('local_office_id');
        if (!$isEditMode) {
            $localOfficePhoto->sort = LocalOfficePhoto::where('local_office_id', $localOfficePhoto->local_office_id)
                    ->max('sort') + self::SORT_STEP;
        }
        $localOfficePhoto->save();

        FileUploader::to($localOfficePhoto, 'sample')
            ->from($request, 'sample')
            ->setDisk('local_office_photos')
            ->store();
        FileUploader::to($localOfficePhoto, 'sample2')
            ->from($request, 'sample2')
            ->setDisk('local_office_photos')
            ->store();
        FileUploader::to($localOfficePhoto, 'mobile')
            ->from($request, 'mobile')
            ->setDisk('local_office_photos')
            ->store();
        FileUploader::to($localOfficePhoto, 'mobile2')
            ->from($request, 'mobile2')
            ->setDisk('local_office_photos')
            ->store();
        FileUploader::to($localOfficePhoto, 'tablet')
            ->from($request, 'tablet')
            ->setDisk('local_office_photos')
            ->store();
        FileUploader::to($localOfficePhoto, 'tablet2')
            ->from($request, 'tablet2')
            ->setDisk('local_office_photos')
            ->store();
        $localOfficePhoto->save();

        return response()->redirectToRoute(
            'admin.local_office_photos.index',
            ['local_office_id' => $localOfficePhoto->local_office_id]
        );
    }

    public function delete(Request $request)
    {
        $localOfficePhoto = LocalOfficePhoto::select(self::FIElDS)
            ->find($request->input('id'));
        $localOfficeId = $localOfficePhoto->local_office_id;
        $localOfficePhoto->delete();
        return response()->redirectToRoute('admin.local_office_photos.index', ['local_office_id' => $localOfficeId]);
    }

    public function move(Request $request)
    {
        $localOfficePhoto = LocalOfficePhoto::select('id', 'local_office_id', 'sort')
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
        $otherLocalOfficePhoto = LocalOfficePhoto::select('id', 'sort')
            ->where('local_office_id', $localOfficePhoto->local_office_id)
            ->where('sort', $sign, $localOfficePhoto->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $localOfficePhoto->sort;
        $localOfficePhoto->sort = $otherLocalOfficePhoto->sort;
        $localOfficePhoto->save();
        $otherLocalOfficePhoto->sort = $sort;
        $otherLocalOfficePhoto->save();

        return response()->redirectToRoute(
            'admin.local_office_photos.index',
            ['local_office_id' => $localOfficePhoto->local_office_id]
        );
    }

}
