<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LanguageIso;
use App\TariffTypeText;
use Illuminate\Http\Request;
use App\TariffType;


class TariffTypeTranslationController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $tariffTypeCount = TariffTypeText::count();

        $languageIsoItems = LanguageIso::select('code_iso', 'name')
            ->has('languages')
            ->with('languages')
            ->with('tariffTypeTexts')
            ->with('languages.site')
            ->paginate(self::PER_PAGE);

        return view('admin.tariff_types_translation.index')
            ->with('languageIsoItems', $languageIsoItems)
            ->with('tariffTypeCount', $tariffTypeCount);
    }

    public function translationList($language)
    {
        $tariffTypes = TariffType::select('id')
            ->with(['tariffTypeTexts' => function ($q) use ($language) {
                $q->whereIn('language_code_iso', [config('app.tariff_default_language'), $language]);
            }])
            ->orderBy('id')
            ->get();
        return view('admin.tariff_types_translation.tariff_types_list')
            ->with('tariffTypes', $tariffTypes)
            ->with('language', $language);
    }

    public function edit(Request $request, $language)
    {
        $tariffTypeId = TariffType::select('id')->findOrFail($request->input('id'));
        $translationItems = TariffTypeText::select('id', 'tariff_type_id', 'name', 'language_code_iso')
            ->where('tariff_type_id', $tariffTypeId->id)
            ->whereIn('language_code_iso', [config('app.tariff_default_language'), $language])
            ->get();
        return view('admin.tariff_types_translation.edit_form')
            ->with('tariffTypeId', $tariffTypeId)
            ->with('translationItems', $translationItems)
            ->with('language', $language);
    }

    public function save(Request $request)
    {
        $tariffTypeText = TariffTypeText::findOrNew($request->input('id'));
        $tariffTypeText->name = $request->input('name');

        $tariffTypeText->tariff_type_id = $request->input('tariff_type_id');
        $tariffTypeText->language_code_iso = $request->input('language_code_iso');
        $tariffTypeText->save();
        return response()->redirectToRoute('admin.tariff_types.translation_list', ['language' => $tariffTypeText->language_code_iso]);
    }

}
