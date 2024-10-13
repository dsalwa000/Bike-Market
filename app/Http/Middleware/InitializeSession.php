<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;

class InitializeSession
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
        if (!Session::has('sendForm')) {
            // Ustaw zmienną sesji
            Session::put('sendForm', false);
        }

        return $next($request);
    }
}
