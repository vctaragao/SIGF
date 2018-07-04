<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
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
        if($request->user()->role == 'director'){

            return redirect('directorHome');

        }elseif ($request->user()->role == 'professor') {
            
            return redirect('professorHome');

        }elseif ($request->user()->role == 'student') {
            
            return redirect('studentHome');
        }

        return $next($request);
    }
}
