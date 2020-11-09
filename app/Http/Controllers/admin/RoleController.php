<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    const PER_PAGE = 10;

    const SORT_STEP = 10;

    public function index()
    {
        $roles = Role::select('id', 'name')
            ->orderBy('sort')
            ->paginate(static::PER_PAGE);
        return view('admin.roles.index')
            ->with('roles', $roles);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $role = Role::select('id', 'name')->find($id);
        } else {
            $role = null;
        }
        return view('admin.roles.form')
            ->with('role', $role);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $role = Role::find($request->input('id'));
        } else {
            $role = new Role();
        }
        $role->name = $request->input('name');
        if (!$isEditMode) {
            $role->sort = Role::max('sort') + self::SORT_STEP;
        }
        $role->save();
        return response()->redirectToRoute('admin.roles.index');
    }

    public function delete(Request $request)
    {
        $role = Role::find($request->input('id'));
        $role->delete();
        return response()->redirectToRoute('admin.roles.index');
    }

    public function move(Request $request)
    {
        $role = Role::select('id', 'sort')
            ->find($request->input('id'));

        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherRole = Role::select('id', 'sort')
            ->where('sort', $sign, $role->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $role->sort;
        $role->sort = $otherRole->sort;
        $role->save();
        $otherRole->sort = $sort;
        $otherRole->save();

        return response()->redirectToRoute('admin.roles.index');
    }


    public function editPermissionList(Request $request)
    {
        $role = Role::select('id', 'name')
            ->with('permissions')
            ->find($request->input('id'));

        $permissions = Permission::select('text_id', 'name')
            ->get();

        return view('admin.roles.permission_list')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    public function savePermissionList(Request $request)
    {
        Role::select('id')
            ->find($request->input('id'))
            ->permissions()
            ->sync($request->input('permission_text_id') ?? []);
        return response()->redirectToRoute('admin.roles.index');
    }

}
