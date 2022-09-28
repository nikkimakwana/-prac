<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    }

    public function authenticate(Request $request)
    {
       $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => 'admin'
        );

        $credentialss = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => 'user'
        );

        if (Auth::attempt($credentials)) 
        {
            return redirect()->intended('/admin');
        }
        else if(Auth::attempt($credentialss))
        {
            return redirect()->intended('/home');
        }
        else
        {
            Session::flash('error', 'Invalid login');
            return redirect('/');
        }
    }
}
