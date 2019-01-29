<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsSekretariat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role == 'murobbi' || Auth::user()->role == 'sekretariat') {  
                if (Auth::user()->status == 'aktif') {
                    return $next($request);
                }else{
                    Auth::logout();
                    return redirect('/')->with('messageBlock', 'Akun telah diblok, silahkan request akun ke admin untuk membukanya.');
                };
            }else{
                return redirect()->back();
            }
        }
    }
}
