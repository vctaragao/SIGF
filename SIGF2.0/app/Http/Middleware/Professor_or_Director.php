<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Professor_or_Director
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

        if (!Auth::guard()->check() || (!$request->user()->isProfessor && !$request->user()->isDirector) ) {
            return redirect('/');
        }

        return $next($request);
    }
}
