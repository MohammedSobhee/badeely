<?php


Route::group(['middleware' => 'HttpsRedirect'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin.localization'], function () {

        Route::group(['middleware' => 'auth.admins'], function () {
            Route::get('/', 'HomeController@index')->name('admin_home');
            Route::get('/change_lang', 'HomeController@changeLang')->name('change_lang');
            Route::view('profile', 'admin.profile');
            Route::post('profile', 'HomeController@profile');
        });

        Route::group(['namespace' => 'Auth'], function () {
            Route::get('/login', 'LoginController@showLoginForm');
            Route::post('/login', 'LoginController@login');
            Route::get('/logout', 'LoginController@logout');
        });

        Route::group(['middleware' => 'auth.admins', 'as' => 'admin.'], function () {

            Route::resource('users', 'UsersController', ['except' => ['show']]);

//            Route::get('users-data', 'UsersController@anyData')->name('users.data');

            Route::resource('accounts', 'AccountsController', ['except' => ['show']]);

            Route::resource('categories', 'CategoriesController', ['except' => ['show']]);

            Route::get('settings', 'SettingsController@get')->name('settings.index');
            Route::post('settings', 'SettingsController@post')->name('settings.edit');

            Route::resource('countries', 'CountriesController', ['except' => ['show']]);

            Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
            Route::post('notifications/send', 'NotificationsController@send')->name('notifications.send');
            Route::delete('notifications/{id}', 'NotificationsController@destroy')->name('notifications.destroy');
            Route::get('items/{country_id}/{type?}/{follow_collection?}', 'NotificationsController@getItems')->name('notifications.items');
            Route::get('categories/{country_id}', 'NotificationsController@getCategoriesByCountry')->name('categories.items');

            Route::resource('search_history', 'SearchHistoryController', ['only' => ['index']]);

            Route::resource('administrators', 'AdministratorsController', ['except' => ['show']]);
            Route::resource('roles', 'RolesController', ['except' => ['show']]);

            Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {

                Route::get('/categories_visits', 'ReportsController@categoriesVisits')->name('categories_visits');
                Route::get('/featured_visits', 'ReportsController@featuredVisits')->name('featured_visits');
                Route::get('/category_featured_visits', 'ReportsController@categoryFeaturedVisits')->name('category_featured_visits');
                Route::get('/vote_report', 'ReportsController@voteReport')->name('vote_report');
                Route::get('/clicks_report', 'ReportsController@clicksReport')->name('clicks_report');
                Route::get('/top_level_clicks', 'ReportsController@topLevelClicks')->name('top_level_clicks');

            });

        });

    });

    Route::group(['prefix' => 'ajax', 'namespace' => 'Admin', 'as' => 'ajax.', 'middleware' => 'admin.localization'], function () {

        Route::get('/categories', ['as' => 'categories', 'uses' => 'HomeController@categoriesAjax']);
        Route::get('/sub_categories', ['as' => 'sub_categories', 'uses' => 'HomeController@subCategoriesAjax']);
        Route::get('/sub_categories_by_country', ['as' => 'sub_categories_by_country', 'uses' => 'HomeController@subCategoriesByCountryAjax']);
        Route::get('/dashboard_statistics', ['as' => 'dashboard_statistics', 'uses' => 'HomeController@dashboardStatistics']);

    });


    /*  TEST UTILITY  */
    Route::get('/pr', function () {

        $routes = \Route::getRoutes()->getRoutesByName();

        //admin.stores.store
        $routes = array_filter($routes, function ($k) {
            return explode('.', $k)[0] == 'admin' && !ends_with($k, 'store') && !ends_with($k, 'update');
            //!str_contains($k, ['.store', '.update']);
        }, ARRAY_FILTER_USE_KEY);

        \DB::table('permissions')->where('role_id', '1')->delete();

        foreach (array_keys($routes) as $v) {
            try {

                \DB::table('permissions')->insert([
                    'role_id' => 1,
                    'permission' => $v
                ]);

            } catch (Exception $exception) {
            }
        }

        dd(array_keys($routes));

    });

});


