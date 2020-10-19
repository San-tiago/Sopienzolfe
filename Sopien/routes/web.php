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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
//admin controller
Route::get('/admin', 'AdminController@index');
Route::get('/admin/menu', 'AdminController@menu');
Route::get('/admin/orders', 'AdminController@orders');
Route::get('/admin/sales', 'AdminController@sales');
Route::get('/admin/users', 'AdminController@users');

//category controller
Route::get('/admin/categories', 'CategoryController@index');
Route::get('/admin/add-category', 'CategoryController@create');
Route::post('/insert-category', 'CategoryController@store');

