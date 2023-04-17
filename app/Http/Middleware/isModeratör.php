<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isModeratör
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->authority_status == 3 || Auth::user()->authority_status == 2 || Auth::user()->authority_status == 1) {
                return $next($request);
            }
        }
        abort(403,  Auth::user() ? 'Unauthorized action.' : 'Please login to continue.');
    }
}
