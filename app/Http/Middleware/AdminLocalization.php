<?php

namespace App\Http\Middleware;

use App;
use Closure;

class AdminLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = $_COOKIE['lang'] ?? 'en';

        if($local)
            App::setLocale($local);
        else
            App::setLocale('en');

        return $next($request);
    }
}
