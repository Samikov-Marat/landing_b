<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $tariffs = Tariff::select('id','ek_id', 'tariff_type_id')->paginate(10);
        return view('admin.tariffs.index', ['tariffs' => $tariffs]);
    }

    public function edit($id)
    {
        if (isset($id)) {
            $tariff = Tariff::select('id','ek_id', 'tariff_type_id')
                ->find($id);
        } else {
            $tariff = null;
        }

        return view('admin.tariffs.form')
            ->with('tariff', $tariff);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'ek_id' => 'required',
            'tariff_type_id' => 'required',
        ]);
        $tariffs = $request->all();
        $tariff = Tariff::select('id','ek_id', 'tariff_type_id')->find($request['id']);
        $tariff->ek_id = $tariffs['ek_id'];
        $tariff->tariff_type_id = $tariffs['tariff_type_id'];
        $tariff->save();
        return response()->redirectToRoute('admin.tariffs.index');
    }

    public function delete(Request $request)
    {
        $tariffs = Tariff::findOrFail($request->input('id'));
        $tariffs->delete();
        return response()->redirectToRoute('admin.tariffs.index');
    }
}
