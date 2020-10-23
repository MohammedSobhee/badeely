<?php

namespace App\Http\Middleware;

use App;
use Blade;
use Closure;
use Auth;

class AdminsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */

    private $exclude = [
        'admin_home',
        'change_lang'
    ];

    public function handle($request, Closure $next, $guard = 'admins')
    {

        if (!Auth::guard($guard)->check()) {
            return redirect('admin/login');
        }

        $this->registerBlade();

        $route = $this->route(\Route::currentRouteName());

        if ($route && !auth('admins')->user()->hasPermission($route)) {
            abort(403, 'Permission denied !!');
        }

        return $next($request);
    }

    private function registerBlade()
    {
        Blade::directive('can', function ($permission) {
            return "<?php if (auth('admins')->user()->hasPermission({$permission})): ?>";
        });

        Blade::directive('endcan', function ($permission) {
            return "<?php endif; ?>";
        });

    }

    private function route($route)
    {
        $tmp = explode('.', $route);
        $verb = end($tmp);

        if ($verb == 'store') {
            $route = lreplace('store', 'create', $route);
        } elseif ($verb == 'update') {
            $route = lreplace('update', 'edit', $route);
        }

        return in_array($route, $this->exclude) ? null : $route;
    }
}
