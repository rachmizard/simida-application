<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticated()
    {
        if(auth()->user()->role == 'murobbi'){
            return redirect()->route('admin.home');
        }else if(auth()->user()->role == 'sekretariat'){
            return redirect()->route('sekretariat.home');
        }else if(auth()->user()->role == 'pendidikan'){
            return redirect()->route('pendidikan.home');
        }else if(auth()->user()->role == 'keuangan'){
            return redirect(url('/keuangan#/keuangan'));
        }else if(auth()->user()->role == 'keamanan'){
            return redirect()->route('keamanan.home');        
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
