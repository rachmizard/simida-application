<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsRoisam
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
            if (Auth::user()->role == 'murobbi' || Auth::user()->role == 'roisam') {   
                return $next($request);
            }else{
                return redirect()->back();
            }
        }
    }
}
