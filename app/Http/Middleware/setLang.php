<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class setLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session()->has('lang')) {
            app()->setLocale(session('lang'));

            return $next($request);
        } else {
            // set lang
            session()->put('lang', 'ar');

            return $next($request);
        }
    }
}
