<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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

        return redirect('/');
    }
}
