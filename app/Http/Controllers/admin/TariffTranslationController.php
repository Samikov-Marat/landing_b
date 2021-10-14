<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;

class TariffTranslationController extends Controller
{
    public function index()
    {
        $languages = Language::select('id', 'language_code_iso', 'site_id', 'name')->paginate(10);
        return view('admin.tariff_translation.tariff_languages', ['languages' => $languages]);
    }
}
