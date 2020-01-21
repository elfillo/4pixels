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

/*Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'department' => 'DepartmentController',
    'user' => 'UserController'
]);*/
Auth::routes();
/*Route::group(['middleware' => ['guest']], function () {
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
});*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
    /*Route::resources([
        'department' => 'DepartmentController',
        'user' => 'UserController'
    ]);*/
});