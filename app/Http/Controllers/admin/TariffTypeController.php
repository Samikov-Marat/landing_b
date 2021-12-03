<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TariffType;


class TariffTypeController extends Controller
{
    public function index()
    {
        $tariffTypes = TariffType::select('id', 'ek_id', 'name')->orderBy('name')->paginate(10);
        return view('admin.tariff_types.index')->with('tariffTypes', $tariffTypes);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $tariffType = TariffType::select('id', 'ek_id', 'name')->where('id', $id)->find($id);
        } else {
            $tariffType = new TariffType();
        }
        return view('admin.tariff_types.form')->with('tariffType', $tariffType);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $tariffType = TariffType::select('id', 'ek_id', 'name')
                ->findOrFail($request->input('id'));
        } else {
            $tariffType = new TariffType();
        }
        $tariffType->ek_id = $request->input('ek_id');
        $tariffType->name = $request->input('name');
        $tariffType->save();
        return response()->redirectToRoute('admin.tariff_types.index');
    }

    public function delete(Request $request)
    {
        $tariffType = TariffType::findOrFail($request->input('id'));
        $tariffType->delete();
        return response()->redirectToRoute('admin.tariff_types.index');
    }
}
