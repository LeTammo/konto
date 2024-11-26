<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $locale = Auth::user()->language ?? config('app.locale');
        } else {
            $locale = Session::get('locale', config('app.locale'));
        }

        app()->setLocale($locale);

        return $next($request);
    }

}
