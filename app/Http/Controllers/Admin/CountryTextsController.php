<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\CountryText;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryTextRequest;
use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryTextsController extends Controller
{
    public function index(Country $country): View
    {
        $country->load('countryTexts');
        $sites = Site::all()
            ->load('languages');

        return view('admin.countries.texts.index')
            ->with('sites', $sites)
            ->with('country', $country);
    }

    public function update(CountryTextRequest $request, int $country, int $languageId): RedirectResponse
    {
        $validated = $request->validated();

        if (!$validated['text']) {
            $this->destroy($country, $languageId);
            return response()->redirectToRoute('admin.countryTexts.index', ['country' => $country]);
        }

        $countryText = CountryText::query()->firstOrNew([
            'country_id' => $country,
            'language_id' => $languageId,
        ]);

        $countryText->value = $validated['text'];
        $countryText->save();

        return response()->redirectToRoute('admin.countryTexts.index', ['country' => $country]);
    }

    public function destroy(int $country, int $text): RedirectResponse
    {
        CountryText::query()
            ->where('country_id', $country)
            ->where('language_id', $text)
            ->delete();

        return response()->redirectToRoute('admin.countryTexts.index', ['country' => $country]);
    }
}
