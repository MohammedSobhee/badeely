<?php

namespace App\Http\Middleware;

use App;
use Closure;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = \Request::server('HTTP_ACCEPT_LANGUAGE');

        if ($local) {
            App::setLocale($local);
        } else {
            App::setLocale('en');
        }


        //update api user
        try {
            $user = api()->user() ?? null;
        } catch (\Exception $ex) {
            $user = null;
        }

        if ($user) {
            $user->update([
                'language' => $local ?? 'en'
            ]);
        }

// if(isset($user) && isset($user->country_id)){

//     config()->set('country',$user->country_id);

// }else 

        if ($request->country_id) {
            config()->set('country', $request->country_id);
        } else {
//            $country = App\Country::where('is_active', 1)->find(151);
            config()->set('country', 151);
        }


        return $next($request);
    }
}
