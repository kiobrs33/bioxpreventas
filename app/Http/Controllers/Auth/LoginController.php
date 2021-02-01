<?php

namespace preventaBiox\Http\Controllers\Auth;

use preventaBiox\Http\Controllers\Controller;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectPath()
    {
        $tipo = auth()->user()->name;

        if ($tipo == "admin") {
            return route('home');
        }else if($tipo == "employee"){
            return route('trabajador.home');
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}