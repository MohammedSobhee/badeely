<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Setting;
use Schema;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('settings')){

            $settings = Cache::rememberForever('settings', function() {
                return Setting::pluck('value','key')->all();
            });

            config()->set('settings', (Array) $settings);

        }

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
