<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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


    protected $redirectTo = RouteServiceProvider::HOME;

    protected $maxAttempts = 10;
    protected $decayMinutes = 1;
    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    protected function authenticated()
    {
        Auth::logoutOtherDevices(request('password'));
        return redirect('/')->with('success', 'Login Success!');
    }

    public function findUsername()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function username()
    {
        return $this->username;
    }

    public function loggedOut()
    {
        return redirect('/login')->with('success', 'Logout Berhasil!');
    }
}
