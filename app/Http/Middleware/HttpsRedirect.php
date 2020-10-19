<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Auth;

class HttpsRedirect
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

        if ( !$request->secure() && env('APP_ENV') === 'production' ) {
            return redirect()->secure($request->path());
        }

        return $next($request);

    }

}

