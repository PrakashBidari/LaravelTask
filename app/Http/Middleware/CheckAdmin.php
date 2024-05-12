<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->role === 'NewsManager') {
            return redirect('/admin');
        }



        return redirect('/'); // Redirect to home if not an admin
    }
}
