<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCurrencyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    public function index(): View
    {
        $currencies = Currency::query()
            ->getAllCurrencies()
            ->get();
        return view('admin.currency.index')
            ->with('currencies', $currencies);
    }

    public function store(AdminCurrencyRequest $request): RedirectResponse
    {
        $currency = new Currency();
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;

        $currency->save();
        return response()->redirectToRoute('admin.currency.index');
    }

    public function update(Currency $currency, AdminCurrencyRequest $request): RedirectResponse
    {
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;

        $currency->save();
        return response()->redirectToRoute('admin.currency.index');
    }

    public function destroy(Currency $currency): RedirectResponse
    {
        $currency->delete();
        return response()->redirectToRoute('admin.currency.index');
    }
}
