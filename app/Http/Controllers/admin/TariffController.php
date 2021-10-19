<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\LanguageIso;
use App\Tariff;
use App\TariffText;
use App\TariffType;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $tariffs = Tariff::with('tariffText')->paginate(self::PER_PAGE);
        return view('admin.tariffs.index', ['tariffs' => $tariffs]);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')->find($id);
            $tariffTexts = $tariff->tariffText;
        } else {
            $tariff = null;
            $languageCodeIso = LanguageIso::select('code_iso')->get();
        }
        $tariffTypes = TariffType::select('id')->get();
        return view('admin.tariffs.form', ['tariff' => $tariff, 'tariffTypes' => $tariffTypes, 'tariffTexts' => $tariffTexts ?? '', 'languageCodeIso' => $languageCodeIso ?? '']);
    }

    public function save(Request $request)
    {
        $tariffs = $request->all();
        $isEditMode = $request->has('id');
        if ($isEditMode){
            $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')->find($request['id']);
            $tariffText = $tariff->tariffText()->where('tariff_id', $request['id'])->first();
        } else {
            $tariff = new Tariff();
            $tariffText = new TariffText();
        }

        $tariff->ek_id = $tariffs['ek_id'];
        $tariff->tariff_type_id = $tariffs['tariff_type_id'];
        $tariff->save();
        if($tariffText = new TariffText()) {
        $value = Tariff::latest()->first();
        $tariffText->tariff_id = $value->id;
        $tariffText->language_code_iso = $tariffs['language_code_iso'];
        }
        $tariffText->name = $tariffs['name'];
        $tariffText->description = $tariffs['description'];

        $tariffText->save();
        return response()->redirectToRoute('admin.tariffs.index');
    }

    public function delete(Request $request)
    {
        $tariffs = Tariff::findOrFail($request->input('id'));
        $tariffs->tariffText()->delete();
        $tariffs->delete();
        return response()->redirectToRoute('admin.tariffs.index');
    }
}
