<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

    public function generate()
    {
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $routeName = $route->getName();
            if (isset($routeName) &&
                Str::startsWith($routeName, 'admin.') &&
                Permission::where('text_id', $routeName)->doesntExist()) {

                $permission = new Permission();
                $permission->text_id = $routeName;
                $permission->name = 'Маршрут ' . $routeName;

                $permission->save();

            }
        }

        return response()->redirectToRoute('admin.permissions.index');
    }


}
