<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Feedback;
use App\Site;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
                [
                    'feedbacks' => function ($query) {
                        $query->select('id', 'site_id', 'language_id', 'name', 'email', 'text', 'published', 'writing_date')
                            ->orderBy('published', 'desc')
                            ->orderBy('writing_date', 'desc');
                    },
                    'feedbacks.language:id,name,shortname',
                ]
            )
            ->find($request->input('site_id'));
        return view('admin.feedbacks.index')
            ->with('site', $site);
    }

    public function edit(Request $request, $id = null)
    {
        if (isset($id)) {
            $feedback = Feedback::select('id', 'site_id', 'language_id', 'name', 'email', 'text', 'published', 'writing_date')
                ->find($id);
            $siteId = $feedback->site_id;
        } else {
            $feedback = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->with(['languages'=>function($query){
                $query->select(['id', 'site_id', 'shortname', 'name'])
                    ->orderBy('sort');
            }])
            ->find($siteId);

        return view('admin.feedbacks.form')
            ->with('site', $site)
            ->with('feedback', $feedback);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $feedback = Feedback::find($request->input('id'));
        } else {
            $feedback = new Feedback();
        }

        $feedback->site_id = $request->input('site_id');
        $feedback->language_id = $request->input('language_id');

        $feedback->name = $request->input('name', '');
        $feedback->email = $request->input('email', '');
        $feedback->text = $request->input('text', '');
        $feedback->writing_date = $request->input('writing_date') . ' ' . $request->input(
                'writing_date_time'
            );

        if ($request->has('published') && (1 == $request->input('published'))) {
            $feedback->published = true;
        } else {
            $feedback->published = false;
        }
        $feedback->save();

        return response()->redirectToRoute('admin.feedbacks.index', ['site_id' => $feedback->site_id]);
    }

    public function delete(Request $request)
    {
        $feedback = Feedback::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $feedback->site_id;
        $feedback->delete();
        return response()->redirectToRoute('admin.feedbacks.index', ['site_id' => $site_id]);
    }

}
