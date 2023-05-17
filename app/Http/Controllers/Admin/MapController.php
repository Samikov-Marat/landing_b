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
        $languages = $site->languages()->get();
        $mapState = $site
            ->getSpecificPage('contacts')
            ->getSpecificTextType('contacts_map_state')
            ->getSpecificText($languages->first()->id)
            ->value;

        return view('admin.map.show')
            ->with('contacts_map_state', $mapState)
            ->with('siteId', $site->id);
    }

    public function update(Site $site, AdminMapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $languages = $site->languages()->get();
        $mapStateTextType = $site
            ->getSpecificPage('contacts')
            ->getSpecificTextType('contacts_map_state');

        foreach ($languages as $language) {
            $textState = $mapStateTextType->getSpecificText($language->id);
            $textState->value = $validated['state'];
            $textState->save();
        }
        return redirect(route('admin.map.show', ['site' => $site]));
    }
}
