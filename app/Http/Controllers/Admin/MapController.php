<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminMapRequest;
use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MapController extends Controller
{
    public function index(): View
    {
        $sites = Site::all();
        return view('admin.map.index')
            ->with('sites', $sites);
    }

    public function show(Site $site): View
    {
        $language = $site->languages()->get();
        $mapState = $site->load([
            'pages' => function ($query) {
                $query->where('url', 'contacts');
            },
            'pages.textTypes' => function ($query) {
                $query->where('shortname', 'contacts_map_state');
            },
            'pages.textTypes.texts' => function ($query) use ($language) {
                $query->where('language_id', $language->first()->id);
            },
        ]);

        return view('admin.map.show')
            ->with('contacts_map_state', $mapState->pages[0]->textTypes[0]->texts[0]->value)
            ->with('siteId', $site->id);
    }

    public function update(Site $site, AdminMapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $languages = $site->languages()->get();
        $mapState = $site->load([
            'pages' => function ($query) {
                $query->where('url', 'contacts');
            },
            'pages.textTypes' => function ($query) {
                $query->where('shortname', 'contacts_map_state');
            },
        ]);
        foreach ($languages as $language) {
            $textState = $mapState->pages[0]->textTypes[0]->load([
                'texts' => function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
            ]);
            $textState->texts[0]->value = $validated['state'];
            $textState->texts[0]->save();
        }
        return redirect(route('admin.map.show', ['site' => $site]));
    }
}
