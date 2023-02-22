<?php

namespace App\Http\Controllers\Admin;

use App\Classes\UserPasswordGenerator;
use App\Classes\UserPasswordNotification;
use App\Franchisee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FranchiseeController extends Controller
{
    public function index()
    {
        $franchisees = Franchisee::select(['id', 'name', 'description', 'subdomain'])
            ->orderBy('name')
            ->with('users')
            ->with('localOffices.site')
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
        $franchisee->subdomain = $request->input('subdomain');
        $franchisee->name = $request->input('name');
        $franchisee->description = $request->input('description');
        $franchisee->save();

        if ($request->input('add_user', 0)) {
            $notification = new UserPasswordNotification();
            $user = new User();
            $password = UserPasswordGenerator::getPassword();
            $notification->setPassword($password);
            $user->password = Hash::make($password);
            $user->name = $request->input('user_name');
            $user->email = $request->input('user_email');
            $user->disabled = 0;
            $user->save();
            $franchisee->users()->attach($user->id);
            $notification->sendTo($user);
        }


        return response()->redirectToRoute('admin.franchisees.index');
    }

    public function delete(Request $request)
    {
        $franchisee = Franchisee::find($request->input('id'));
        $franchisee->users()->detach();
        $franchisee->localOffices()->update(['franchisee_id' => null]);
        $franchisee->delete();
        return response()->redirectToRoute('admin.franchisees.index');
    }


    public function addUser(Request $request)
    {
        $franchisee = Franchisee::find($request->input('franchisee_id'));

        return view('admin.franchisees.add_user_form')
            ->with('franchisee', $franchisee);
    }


    public function saveUser(Request $request)
    {
        $franchisee = Franchisee::find($request->input('franchisee_id'));

        $notification = new UserPasswordNotification();
        $user = new User();
        $password = UserPasswordGenerator::getPassword();
        $notification->setPassword($password);
        $user->password = Hash::make($password);
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->disabled = 0;
        $user->save();
        $franchisee->users()->attach($user->id);
        $notification->sendTo($user);

        return response()->redirectToRoute('admin.franchisees.index');
    }

}
