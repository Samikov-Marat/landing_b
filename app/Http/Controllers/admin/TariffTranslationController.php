<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return view('admin.tariff_translation.tariff_languages', ['languageIsoItems' => $languageIsoItems, 'tariffCount' => $tariffCount]);
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

    public function edit(Request $request)
    {
        $language = $request['language'];
        $id = $request['id'];
        $translationItems = TariffText::where('tariff_id', $request['id'])->where('language_code_iso', $language)->get();
        return view('admin.tariff_translation.edit_form')->with(['translationItems' => $translationItems, 'language' => $language, 'id' => $id]);
    }

    public function save(Request $request)
    {
        $lang = $request['language_code_iso'];
        $tariffText = TariffText::find($request['id']);
        if ($tariffText == null) {
            $tariffText = new TariffText();
        }
        $tariffText->name = $request['name'];
        $tariffText->description = $request['description'];
        $tariffText->tariff_id = $request['tariff_id'];
        $tariffText->language_code_iso = $request['language_code_iso'];
        $tariffText->save();
        return response()->redirectToRoute('admin.tariff_translation', $lang);
    }

}
