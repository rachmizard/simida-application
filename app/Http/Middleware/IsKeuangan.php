<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsKeuangan
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
            if (Auth::user()->role == 'murobbi' || Auth::user()->role == 'keuangan') {   
                return $next($request);
            }else{
                return redirect()->back();
            }
        }
    }
}
