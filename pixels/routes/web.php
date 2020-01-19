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

//Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/departments', 'DepartmentController@index')->name('department');
Route::get('/department/create/', 'DepartmentController@create')->name('department.create');
Route::post('/departments', 'DepartmentController@store')->name('department.store');
Route::post('/departments/{id}', 'DepartmentController@update')->name('department.update');
Route::get('/department/{id}/edit/', 'DepartmentController@edit')->name('department.edit');
Route::get('/department/{id}/delete/', 'DepartmentController@destroy')->name('department.delete');

Route::get('/users', 'UserController@index')->name('user');
Route::get('/user/create/', 'UserController@create')->name('user.create');
Route::post('/users', 'UserController@store')->name('user.store');
Route::post('/users/{id}', 'UserController@update')->name('user.update');
Route::get('/user/{id}/edit/', 'UserController@edit')->name('user.edit');
Route::get('/user/{id}/delete/', 'UserController@destroy')->name('user.delete');
