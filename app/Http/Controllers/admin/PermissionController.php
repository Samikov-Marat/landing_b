<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    const PER_PAGE = 10;

    public function index()
    {
        $permissions = Permission::select('text_id', 'name')
            ->orderBy('text_id')
            ->paginate(static::PER_PAGE);
        return view('admin.permissions.index')
            ->with('permissions', $permissions);
    }


    public function edit($id = null)
    {
        if (isset($id)) {
            $permission = Permission::select('text_id', 'name')
                ->find($id);
        } else {
            $permission = null;
        }

        return view('admin.permissions.form')
            ->with('permission', $permission);
    }

    public function save(Request $request)
    {
        $isEditMode = ($request->input('mode') == 'old');
        if ($isEditMode) {
            $permission = Permission::find($request->input('text_id'));
        } else {
            $permission = new Permission();
        }
        if (!$isEditMode) {
            $permission->text_id = $request->input('text_id');
        }
        $permission->name = $request->input('name');
        $permission->save();
        return response()->redirectToRoute('admin.permissions.index');
    }

    public function delete(Request $request)
    {
        $permission = Permission::find($request->input('id'));
        $permission->delete();
        return response()->redirectToRoute('admin.permissions.index');
    }

}
