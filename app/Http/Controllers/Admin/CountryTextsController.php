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
        $sites = Site::all()->load('languages');

        $countriesTexts = [];

        $sites->each(static function ($site) use (&$countriesTexts, $country) {
            $site->languages->each(static function ($language) use (&$countriesTexts, $country) {
                $countryText = $country->countryTexts->firstWhere('language_id', $language->id);
                $countriesTexts[$language->id] = $countryText->value ?? $countryText;
            });
        });

        return view('admin.countries.texts.index')
            ->with('sites', $sites)
            ->with('countriesTexts', $countriesTexts)
            ->with('countryId', $country->id);
    }

    public function update(CountryTextRequest $request, int $country, int $text): RedirectResponse
    {
        $validated = $request->validated();

        if (!$validated['text']) {
            $this->destroy($country, $text);
        }

        $lang = CountryText::query()->firstOrNew([
            'country_id' => $country,
            'language_id' => $text,
        ]);

        $lang->value = $validated['text'];
        $lang->save();

        return redirect(route('admin.countryTexts.index', ['country' => $country]));
    }

    public function destroy(int $country, int $text): RedirectResponse
    {
        CountryText::query()
            ->where('country_id', $country)
            ->where('language_id', $text)
            ->delete();

        return redirect(route('admin.countryTexts.index', ['country' => $country]));
    }
}
