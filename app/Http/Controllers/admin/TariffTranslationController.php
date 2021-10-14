<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\LanguageIso;
use Illuminate\Http\Request;

class TariffTranslationController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $languageIsoItems = LanguageIso::select('code_iso', 'name')
            ->has('languages')
            ->with('languages')
            ->with('languages.site')
            ->get();

        return view('admin.tariff_translation.tariff_languages')
            ->with('languageIsoItems', $languageIsoItems);
    }
}
