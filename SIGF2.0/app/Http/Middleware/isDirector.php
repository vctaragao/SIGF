<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isDirector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if (!Auth::guard()->check() || !$request->user()->isDirector ) {
            return redirect('/');
        }
         
                                                 
        return $next($request);
    }
}
