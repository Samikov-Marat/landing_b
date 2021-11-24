<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\LanguageIso;
use App\Tariff;
use App\TariffText;
use Illuminate\Http\Request;

class TariffTranslationController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $tariffCount = Tariff::select('id')->count();
        $languageIsoItems = LanguageIso::select('code_iso', 'name')
            ->has('languages')
            ->with('languages')
            ->with('tariffText')
            ->with('languages.site')
            ->paginate(self::PER_PAGE);
        return view('admin.tariff_translation.tariff_languages')
            ->with('languageIsoItems', $languageIsoItems)
            ->with('tariffCount', $tariffCount);
    }

    public function translationList($language)
    {
        $tariffs = Tariff::select('id')
            ->with(['tariffText' => function ($q) use ($language) {
                $q->whereIn('language_code_iso', [config('app.tariff_default_language'), $language]);
            }])
            ->orderBy('id')
            ->get();

        return view('admin.tariff_translation.translation_list')
            ->with('tariffs', $tariffs)
            ->with('language', $language);
    }

    public function edit(Request $request, $language)
    {
        $tariff = Tariff::select('id')->findOrFail($request->input('id'));
        $translationItems = TariffText::select('id', 'tariff_id', 'language_code_iso', 'name', 'description')
            ->where('tariff_id', $tariff->id)
            ->whereIn('language_code_iso', [config('app.tariff_default_language'), $language])
            ->get();
        return view('admin.tariff_translation.edit_form')
            ->with(['tariff' => $tariff, 'translationItems' => $translationItems, 'language' => $language]);
    }

    public function save(Request $request)
    {
        $tariffText = TariffText::findOrNew($request->input('id'));
        $tariffText->name = $request->input('name');
        $tariffText->description = $request->input('description');
        $tariffText->tariff_id = $request->input('tariff_id');
        $tariffText->language_code_iso = $request->input('language_code_iso');
        $tariffText->save();
        return response()->redirectToRoute('admin.tariff_translation', ['language' => $tariffText->language_code_iso]);
    }

    public function siteTariffs(Request $request)
    {
        $site_id = $request->input('site_id');
        $tariffs = Language::select('site_id', 'language_code_iso')
            ->where('site_id', $site_id)
            ->with('tariffText')
            ->paginate(self::PER_PAGE);
        return view('admin.tariffs.site_tariffs', ['tariffs' => $tariffs]);
    }
}
