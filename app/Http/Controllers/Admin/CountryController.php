<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Country;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $countries = Country::all();
        return view('admin.countries.index')
            ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CountryRequest $request)
    {
        $validated = $request->validated();

        $country = new Country();
        $country->jira_code = $validated['jira_code'];
        $country->can_send = isset($validated['can_send']);
        $country->can_receive = isset($validated['can_receive']);

        $country->save();
        return redirect(route('countries.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryRequest $request, int $id)
    {
        $validated = $request->validated();
        $country = Country::query()->findOrFail($id);

        $country->jira_code = $validated['jira_code'];
        $country->can_send = isset($validated['can_send']);
        $country->can_receive = isset($validated['can_receive']);

        $country->save();
        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Country::query()->findOrFail($id)->delete();
        return redirect(route('countries.index'));
    }
}
