<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'HttpsRedirect'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();
    Route::redirect('login', 'admin/login');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('verification/verify', [ 'as' => 'verification.verify' , 'uses' => 'VerificationController@verify' ]);

});
