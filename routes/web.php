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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/status', 'StatusController@index')->name('statusesIndex');

    //    Route::get('/', function ()    {
//        // Uses Auth Middleware
//    });
//
//    Route::get('user/profile', function () {
//        // Uses Auth Middleware
//    });
});

