<?php


Route::group(['namespace' => 'Api', 'middleware' => ['api.localization', 'HttpsRedirect']], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

        Route::post('registry', 'RegisterController@register');

        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout');

        Route::post('verification', 'RegisterController@verification');
        Route::post('verification/resend', 'RegisterController@resendVerification');


        Route::post('forget_password', 'ForgetPasswordController@getResetToken');
        Route::post('reset_password', 'ForgetPasswordController@resetPassword');

        Route::post('social_login/{provider}', 'LoginController@loginBySocial');

    });

    Route::get('home', 'HomeController@index');

    Route::get('countries', 'HomeController@countries');

    Route::get('categories', 'CategoriesController@index');
    Route::get('categories2', 'CategoriesController@index2');
    Route::get('categories/{id}', 'CategoriesController@show');

    Route::get('categories/{id}/accounts', 'CategoriesController@accounts');
    Route::get('categories/{id}/all_accounts', 'CategoriesController@allAccounts');
    Route::post('categories/{id}/add_click', 'CategoriesController@addClick')->middleware('auth.api');
    Route::post('feature_category/add_view', 'CategoriesController@addView')->middleware('auth.api');

    Route::group(['prefix' => 'user', 'middleware' => 'auth.api'], function () {

        Route::get('profile', 'UsersController@show');
        Route::post('update', 'UsersController@update');
        Route::post('password', 'UsersController@password');

        Route::get('my_upvotes', 'UsersController@upVotes');

    });


    Route::get('notifications', 'NotificationController@index')->middleware('auth.api');
    Route::delete('notification/{id}', 'NotificationController@delete')->middleware('auth.api');

    Route::get('accounts', 'AccountsController@index');
    Route::post('accounts', 'AccountsController@store')->middleware('auth.api');
    Route::post('accounts/{id}/vote', 'AccountsController@vote')->middleware('auth.api');
    Route::post('accounts/{id}/add_view', 'AccountsController@addView')->middleware('auth.api');
    Route::post('accounts_by_tags', 'AccountsController@getAccountsByTag');
    Route::post('categories/{id}/add_follow', 'FollowCategoryController@addFollow')->middleware('auth.api');
    Route::get('follows', 'FollowCategoryController@getFollows')->middleware('auth.api');

    Route::get('configs', 'HomeController@configs');


    Route::post('top_level_click', 'HomeController@topLevelClick')->middleware('auth.api');

//    Route::post('accounts/{id}/click','AccountsController@click')->middleware('auth.api');
//    Route::post('accounts/{id}/instagram_click','AccountsController@instagramClick')->middleware('auth.api');

//    Route::get('users','UsersController@index')->middleware('auth.api');
//    Route::get('users/check_username','UsersController@checkUsername');
//    Route::get('user/{id}','UsersController@userById');
//    Route::post('user/{id}/rate','UsersController@rate')->middleware('auth.api');


//    Route::get('pages','HomeController@pages');
//    Route::get('countries','HomeController@countries');
//    Route::post('contact_us','HomeController@contactUs');
//
//
//    Route::get('sliders','SlidersController@index');
//
//
//
//    Route::get('categories/{id}/products','CategoriesController@index');
//    Route::get('products/{id}','ProductsController@show');
//
//    Route::post('products','ProductsController@store')->middleware('auth.api');
//    Route::post('products/{id}/extend','ProductsController@extend')->middleware('auth.api');


});