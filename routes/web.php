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
//Backend routes
Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    //Dashboard routes
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    //User routes
    Route::resource('user', 'Admin\UserController', ['except' => ['show']]);
    Route::put('/password/{id}',['as' => 'password.change','uses' => 'Admin\UserController@changePassword']);
    //Profile routes
    Route::group([
        'prefix' => 'profile'
    ], function () {
        Route::get('/', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
        Route::put('/', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
        Route::put('password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
    });
    //Ability routes
    Route::resource('ability', 'Admin\AbilityController');

    //Role routes
    Route::resource('role', 'Admin\RoleController');
});

