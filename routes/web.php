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
    Route::get('/status/add', 'StatusController@create')->name('statusesAdd');
    Route::post('/status/add', 'StatusController@store')->name('statusesStore');

    Route::get('/category', 'CategoryController@index')->name('categoriesIndex');
    Route::get('/category/add', 'CategoryController@create')->name('categoriesAdd');
    Route::post('/category/add', 'CategoryController@store')->name('categoriesStore');

    Route::get('/category/{category}/edit', 'CategoryController@edit')->name('categoriesEdit');
    Route::post('/category/{category}/edit', 'CategoryController@update')->name('categoriesUpdate');
    Route::get('/category/{category}/delete', 'CategoryController@delete')->name('categoriesDelete');
});

Route::group(['middleware' => 'student'], function () {


});

Route::group(['middleware' => 'profesor'], function () {


});