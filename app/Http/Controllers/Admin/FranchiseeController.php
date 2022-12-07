<?php

namespace App\Http\Controllers\Admin;

use App\Franchisee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FranchiseeController extends Controller
{
    public function index()
    {
        $franchisees = Franchisee::select(['id', 'name', 'description',])
            ->orderBy('name')
            ->get();
        return view('admin.franchisees.index')
            ->with('franchisees', $franchisees);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $franchisee = Franchisee::find($id);
        } else {
            $franchisee = new Franchisee();
        }

        return view('admin.franchisees.form')
            ->with('franchisee', $franchisee);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $franchisee = Franchisee::find($request->input('id'));
        } else {
            $franchisee = new Franchisee();
        }
        $franchisee->name = $request->input('name');
        $franchisee->description = $request->input('description');
        $franchisee->save();

        return response()->redirectToRoute('admin.franchisees.index');
    }

    public function delete(Request $request)
    {
        $franchisee = Franchisee::find($request->input('id'));
        $franchisee->delete();
        return response()->redirectToRoute('admin.franchisees.index');
    }


}
