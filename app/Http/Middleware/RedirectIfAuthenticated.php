<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role == 'murobbi') {
                return redirect()->route('admin.home');
            }else if(Auth::user()->role == 'sekretariat'){
                return redirect()->route('sekretariat.home');
            }else if(Auth::user()->role == 'pendidikan'){
                return redirect()->route('pendidikan.home');
            }else if(Auth::user()->role == 'keuangan'){
                return redirect()->route('keuangan.home');
            }else if(Auth::user()->role == 'keamanan'){
                return redirect()->route('keamanan.home'); 
            }
        }

        return $next($request);
    }
}
