<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Tariff;
use App\TariffText;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $tariffs = Tariff::with('tariffText')->paginate(10);
        return view('admin.tariffs.index', ['tariffs' => $tariffs]);
    }

    public function edit($id)
    {
        if (isset($id)) {
            $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')->find($id);
            $tariffTexts = $tariff->tariffText;
        } else {
            $tariff = null;
        }
        $tariffTypes = Tariff::select('tariff_type_id')->get();
        return view('admin.tariffs.form', ['tariff' => $tariff, 'tariffTypes' => $tariffTypes, 'tariffTexts' => $tariffTexts]);

    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'ek_id' => 'required',
            'tariff_type_id' => 'required',
        ]);
        $tariffs = $request->all();
        $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')->find($request['id']);
        $tariff->ek_id = $tariffs['ek_id'];
        $tariff->tariff_type_id = $tariffs['tariff_type_id'];
        $tariffText = $tariff->tariffText()->where('tariff_id', $request['id'])->first();
        $tariffText->name = $tariffs['name'];
        $tariffText->description = $tariffs['description'];
        $tariffText->save();
        $tariff->save();
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
