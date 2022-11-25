<?php

namespace App\Http\Controllers\Admin;

use App\Classes\UserPasswordGenerator;
use App\Classes\UserPasswordNotification;
use App\Classes\UserRepository;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const PER_PAGE = 10;
    const PERMISSION_ATTRIBUTE = 'allPermissions';

    public function index()
    {
        $users = User::select('id', 'name', 'email', 'disabled')
            ->orderBy('name')
            ->orderBy('id')
            ->with('roles')
            ->get();

        return view('admin.users.index')
            ->with('users', $users);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $user = User::select('id', 'name', 'email', 'disabled')->find($id);
        } else {
            $user = null;
        }

        return view('admin.users.form')
            ->with('user', $user);
    }

    public function save(Request $request)
    {
        $notification = new UserPasswordNotification();
        if ($request->has('id')) {
            $user = User::find($request->input('id'));
        } else {
            $user = new User();
            $password = UserPasswordGenerator::getPassword();
            $notification->setPassword($password);
            $user->password = Hash::make($password);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->disabled = $request->input('disabled', 0);
        $user->save();

        $notification->sendTo($user);

        return response()->redirectToRoute('admin.users.index');
    }

    public function delete(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();
        return response()->redirectToRoute('admin.users.index');
    }


    public function editRoleList(Request $request)
    {
        $user = User::select('id', 'name', 'email')
            ->with('roles')
            ->find($request->input('id'));

        $roles = Role::select('id', 'name')
            ->orderBy('sort')
            ->get();

        return view('admin.users.role_list')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function saveRoleList(Request $request)
    {
        User::select('id')
            ->find($request->input('id'))
            ->roles()
            ->sync($request->input('role_id', []));
        return response()->redirectToRoute('admin.users.index');
    }

    public function permissionTree()
    {
        $users = User::select('id', 'name')
            ->with('roles:id,name')
            ->with('roles.permissions:text_id')
            ->get();

        UserRepository::attachPermissions($users, self::PERMISSION_ATTRIBUTE);

        return view('admin.users.permission_tree')
            ->with('users', $users);
    }

}
