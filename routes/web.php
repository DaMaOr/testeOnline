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

    Route::get('/users/list', 'HomeController@usersList')->name('usersList');
    Route::get('/users/{user}/{status}', 'HomeController@usersChangeStat')->name('usersChangeStat');

});

Route::group(['middleware' => 'student'], function () {

    Route::get('/teste-student', 'TestController@index')->name('testsIndex');
    Route::get('/teste-student/{test}/access', 'TestController@access')->name('testAccess');
    Route::post('/teste-student/{test}/check-key', 'TestController@checkKey')->name('testCheckKey');
    Route::post('/teste-student/{test}/test-taken', 'TestController@takeTest')->name('testsTaken');
    Route::get('/teste-student/{test}/taken', 'TestController@takenTest')->name('taken');

    Route::get('/cursuri-student', 'CategoryController@indexStud')->name('categoriesIndexStud');

});

Route::group(['middleware' => 'profesor'], function () {

    Route::get('/teste-profesor', 'TestController@indexProf')->name('testsIndexProf');

    Route::get('/status', 'StatusController@index')->name('statusesIndex');
    Route::get('/status/add', 'StatusController@create')->name('statusesAdd');
    Route::post('/status/add', 'StatusController@store')->name('statusesStore');

    Route::get('/cursuri-profesor', 'CategoryController@index')->name('categoriesIndex');
    Route::get('/cursuri-profesor/add', 'CategoryController@create')->name('categoriesAdd');
    Route::post('/cursuri-profesor/add', 'CategoryController@store')->name('categoriesStore');
    Route::get('/cursuri-profesor/{category}/edit', 'CategoryController@edit')->name('categoriesEdit');
    Route::post('/cursuri-profesor/{category}/edit', 'CategoryController@update')->name('categoriesUpdate');
    Route::get('/cursuri-profesor/{category}/delete', 'CategoryController@delete')->name('categoriesDelete');

    Route::get('/teste-profesor/add', 'TestController@create')->name('testsAdd');
    Route::post('/teste-profesor/add', 'TestController@store')->name('testsStore');
    Route::get('/teste-profesor/{test}/edit', 'TestController@edit')->name('testsEdit');
    Route::post('/teste-profesor/{test}/edit', 'TestController@update')->name('testsUpdate');
    Route::get('/teste-profesor/{test}/delete', 'TestController@delete')->name('testsDelete');
});



Route::group(['middleware' => 'auth'], function () {
     Route::get('/test/{test}/note', 'TestController@gradeList')->name('testGradeList');
});
