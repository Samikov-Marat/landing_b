<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminMapRequest;
use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MapController extends Controller
{
    private const CONTACTS_PAGE_NAME = 'contacts';
    private const CONTACTS_MAP_STATE_TEXT_TYPE = 'contacts_map_state';

    public function show(Site $site): View
    {
        $languages = $site->languages()->get();

        $mapState = $site
            ->getSpecificPage(self::CONTACTS_PAGE_NAME)
            ->getSpecificTextType(self::CONTACTS_MAP_STATE_TEXT_TYPE)
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
            ->getSpecificPage(self::CONTACTS_PAGE_NAME)
            ->getSpecificTextType(self::CONTACTS_MAP_STATE_TEXT_TYPE);

        foreach ($languages as $language) {
            $textState = $mapStateTextType->getSpecificText($language->id);
            $textState->value = $validated['state'];
            $textState->save();
        }
        return response()->redirectToRoute('admin.map.show', ['site' => $site]);
    }
}
