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
        $country->can_send = empty($validated['can_send']);
        $country->can_receive = empty($validated['can_receive']);

        $country->save();
        return redirect(route('admin.countries.index'));
    }

    public function update(CountryRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        $country = Country::query()->findOrFail($id);

        $country->jira_code = $validated['jira_code'];
        $country->can_send = empty($validated['can_send']);
        $country->can_receive = empty($validated['can_receive']);

        $country->save();
        return redirect(route('admin.countries.index'));
    }

    public function destroy($id): RedirectResponse
    {
        Country::query()->findOrFail($id)->delete();
        return redirect(route('admin.countries.index'));
    }
}
