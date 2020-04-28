<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class IsMod - Predstavlja middleware klasu koja ima zadatak da proveri da li je
 * autentifikovan korisnik moderator
 * @package App\Http\Middleware
 */
class IsMod
{
    /**
     * Handle an incoming request.
     *
     * Checks if currently authenticated user is moderator user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (Auth::user() &&  Auth::user()->isMod == 1) {
            return $next($request);
        }

        return redirect('/');//->back();
    }
}
