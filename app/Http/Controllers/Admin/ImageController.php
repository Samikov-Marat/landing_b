<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
                [
                    'images' => function ($query) {
                        $query->select('id', 'site_id', 'url', 'path', 'sort', 'is_download')
                            ->orderBy('sort');
                    },
                ]
            )
            ->find($request->input('site_id'));

        return view('admin.images.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $image = Image::select('id', 'url', 'path', 'page_id', 'site_id', 'is_download')
                ->find($id);
            $siteId = $image->site_id;
        } else {
            $image = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->find($siteId);

        return view('admin.images.form')
            ->with('site', $site)
            ->with('image', $image);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $image = Image::find($request->input('id'));
        } else {
            $image = new Image();
        }

        $image->site_id = $request->input('site_id');
        $image->page_id = $request->input('page_id');
        $image->url = $request->input('url');
        $image->is_download = $request->boolean('download');

        if (!$isEditMode) {
            $image->sort = Image::where('site_id', $image->site_id)->max('sort') + self::SORT_STEP;
        }

        if ($request->hasFile('file')) {
            if ($isEditMode && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->path = $request->file('file')
                ->store('/images/' . $image->page_id, ['disk' => 'public']);
            $image->name = $request->file('file')->getClientOriginalName();
        }
        $image->save();

        return response()->redirectToRoute('admin.images.index', ['site_id' => $image->site_id]);
    }

    public function delete(Request $request)
    {
        $image = Image::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $image->site_id;
        $image->delete();
        return response()->redirectToRoute('admin.images.index', ['site_id' => $site_id]);
    }

    public function move(Request $request)
    {
        $image = Image::select('id', 'site_id', 'sort')
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
        $otherImage = Image::select('id', 'sort')
            ->where('site_id', $image->site_id)
            ->where('sort', $sign, $image->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $image->sort;
        $image->sort = $otherImage->sort;
        $image->save();
        $otherImage->sort = $sort;
        $otherImage->save();

        return response()->redirectToRoute('admin.images.index', ['site_id' => $image->site_id]);
    }
}
