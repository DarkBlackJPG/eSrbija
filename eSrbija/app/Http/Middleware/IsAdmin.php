<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

/**
 * Class IsAdmin - middleware klasa koja treba da proveri da li je autentifikovan
 * korisnik administrator
 * @package App\Http\Middleware
 */
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * Checks if currently authenticated user is administrator user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @author Stefan Teslic
     */
    public function handle($request, Closure $next)
    {


        if (Auth::user() &&  Auth::user()->isAdmin == 1) {

            return $next($request);
        }

        return redirect('/');
    }
}
