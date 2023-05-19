<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Country;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(): View
    {
        $countries = Country::all();
        return view('admin.countries.index')
            ->with('countries', $countries);
    }

    public function create(CountryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $country = new Country();
        $country->jira_code = $validated['jira_code'];
        $country->can_send = !empty($validated['can_send']);
        $country->can_receive = !empty($validated['can_receive']);

        $country->save();
        return response()->redirectToRoute('admin.countries.index');
    }

    public function update(CountryRequest $request, Country $country): RedirectResponse
    {
        $validated = $request->validated();

        $country->jira_code = $validated['jira_code'];
        $country->can_send = !empty($validated['can_send']);
        $country->can_receive = !empty($validated['can_receive']);

        $country->save();
        return response()->redirectToRoute('admin.countries.index');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();
        return response()->redirectToRoute('admin.countries.index');
    }
}
