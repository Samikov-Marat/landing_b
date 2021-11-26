<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Tariff;
use App\TariffText;
use App\TariffType;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $tariffs = Tariff::select('id', 'ek_id', 'tariff_type_id')
            ->with(['tariffTexts' => function ($q) {
                $q->where('language_code_iso', config('app.tariff_default_language'));
            }])
            ->with('tariffType')
            ->orderBy('id')
            ->paginate(self::PER_PAGE);

        return view('admin.tariffs.index', ['tariffs' => $tariffs]);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')
                ->with(['tariffTexts' => function ($q) {
                    $q->where('language_code_iso', config('app.tariff_default_language'));
                }])
                ->find($id);
        } else {
            $tariff = new Tariff();
        }
        $tariffTypes = TariffType::select('id', 'name')->get();
        return view('admin.tariffs.form', ['tariff' => $tariff, 'tariffTypes' => $tariffTypes]);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $tariff = Tariff::select('id', 'ek_id', 'tariff_type_id')
                ->findOrFail($request->input('id'));
        } else {
            $tariff = new Tariff();
        }
        $tariff->ek_id = $request->input('ek_id');
        $tariff->tariff_type_id = $request->input('tariff_type_id');
        $tariff->save();

        if ($isEditMode) {
            $tariff->load(['tariffTexts' => function ($q) {
                $q->where('language_code_iso', config('app.tariff_default_language'));
            }]);
            if ($tariff->tariffTexts->count() != 1) {
                throw new Exception('Не найден стандартный перевод');
            }
            $tariffText = $tariff->tariffTexts->first();
        } else {
            $tariffText = new TariffText();
            $tariffText->tariff_id = $tariff->id;
            $tariffText->language_code_iso = config('app.tariff_default_language');
        }
        $tariffText->name = $request->input('name');
        $tariffText->description = $request->input('description');
        $tariffText->save();

        return response()->redirectToRoute('admin.tariffs.index');
    }

    public function delete(Request $request)
    {
        $tariffs = Tariff::findOrFail($request->input('id'));
        $tariffs->tariffTexts()->delete();
        $tariffs->delete();
        return response()->redirectToRoute('admin.tariffs.index');
    }
}
