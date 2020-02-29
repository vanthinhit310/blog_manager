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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group([
    'as' => 'app.'
], function () {
    /**
     **Un authenticated route of application
     **/
    Route::group([
        'middleware' => 'web'
    ], function () {
        Route::get('/', 'HomeController@index')->name('home');
    });
    /**
     **Authenticated route of application
     **/
    Route::group([
        'middleware' => 'auth'
    ], function () {

    });
});

Auth::routes();
Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::resource('user', 'Admin\UserController', ['except' => ['show']]);
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
});

