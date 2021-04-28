<?php

namespace App\Http\Controllers\Auth;

use App\Classes\AliasHttpCookie;
use App\Classes\AuthLoginReturn;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('http.secure');
    }

    public function showLoginForm()
    {
        $aliasReturn = AuthLoginReturn::exists() ? AuthLoginReturn::get() : '';
        return view('auth.login')
            ->with('aliasReturn', $aliasReturn);
    }

    protected function loggedOut(Request $request)
    {
        return response()->redirectToRoute('admin.index');
    }

    protected function authenticated(Request $request, $user)
    {
        Cookie::queue(AliasHttpCookie::getInstance()->get());
        if (AuthLoginReturn::exists()) {
            return redirect(AuthLoginReturn::getAndClear());
        }
    }
}
