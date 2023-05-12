<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\CountryText;
use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryLangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $countryId): View
    {
        $sites = Site::all()->load('languages');

        $country = Country::query()
            ->findOrFail($countryId)
            ->load('country_text');

        $countriesTexts = [];

        $sites->each(static function($site) use (&$countriesTexts, $country) {
            $site->languages->each(static function($language) use (&$countriesTexts, $country) {
                $countryText = $country->country_text->firstWhere('language_id', $language->id);
                $countriesTexts[$language->id] = $countryText->value ?? $countryText;
            });
        });

        return view('admin.countries.lang.index')
            ->with('sites', $sites)
            ->with('countriesTexts', $countriesTexts)
            ->with('countryId', $countryId);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $countryId, int $langId)
    {
        $lang = CountryText::query()->firstOrNew([
            'country_id' => $countryId,
            'language_id' => $langId
        ]);

        $lang->value = $request->input('lang');
        $lang->save();

        return redirect(route('lang.index', ['country' => $countryId]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
