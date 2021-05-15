<?php

namespace App\Http\Middleware;

use Closure;

class LogAuth
{
    public function handle($request, Closure $next, $guard = null)
    {
        // dd(session()->all());
        if(session()->has('authenticated')) {
            return $next($request);    
        } else {
            return redirect('/login');
        }
    }
}