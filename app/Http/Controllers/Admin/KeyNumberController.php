<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KeyNumbers;
use Illuminate\Http\Request;

class KeyNumberController extends Controller
{

    public function index(Request $request)
    {
        $keyNumbers = KeyNumbers::select(['id', 'shortname', 'value', 'description'])
            ->orderBy('id')
            ->get();
        return view('admin.key_numbers.index')
            ->with('keyNumbers', $keyNumbers);
    }

    public function edit(Request $request)
    {
        if ($request->route()->hasParameter('id')) {
            $keyNumber = KeyNumbers::select(['id', 'shortname', 'value', 'description'])
                ->findOrFail($request->route()->parameter('id'));
        } else {
            $keyNumber = new KeyNumbers();
        }
        return view('admin.key_numbers.form')
            ->with('keyNumber', $keyNumber);
    }

    public function save(Request $request)
    {
        if ($request->has('id')) {
            $keyNumber = KeyNumbers::find($request->input('id'));
        } else {
            $keyNumber = new KeyNumbers();
        }
        $keyNumber->shortname = $request->input('shortname');
        $keyNumber->value = $request->input('value');
        $keyNumber->description = $request->input('description');
        $keyNumber->save();
        return response()->redirectToRoute('admin.key_numbers.index');
    }

    public function delete(Request $request)
    {
        $keyNumber = KeyNumbers::find($request->input('id'));
        $keyNumber->delete();
        return response()->redirectToRoute('admin.key_numbers.index');
    }

}
