<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSiteCurrencyRequest;
use App\Site;
use Illuminate\View\View;

class SiteCurrencyController extends Controller
{
    public function index(Site $site): View
    {
        $currencies = Currency::query()
            ->getAllCurrencies()
            ->get();

        $currentCurrency = $site->currency()->first();

        return view('admin.currency.site.index')
            ->with('site', $site)
            ->with('currencies', $currencies)
            ->with('currentCurrency', $currentCurrency);
    }

    public function update(Site $site, AdminSiteCurrencyRequest $request)
    {
        $site->currency_code = $request->currencyCode;
        $site->save();
        return response()->redirectToRoute('admin.site.currency.index', ['site' => $site]);
    }
}
