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
Route::get('/menu/{category}', 'HomeController@menu_nav');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
//admin controller
Route::get('/admin', 'AdminController@index');
Route::get('/admin/menu', 'AdminController@menu');
Route::get('/admin/orders', 'AdminController@orders');
Route::get('/admin/sales', 'AdminController@sales');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/pending-order/{email}', 'AdminController@filtered_pendingorders');
Route::get('/admin/approve-order/{email}', 'AdminController@filtered_approveorders');
Route::get('/admin/process-order/{email}', 'AdminController@filtered_processorders');
Route::get('/admin/ondelivery-order/{email}', 'AdminController@filtered_ondeliveryorders');

Route::get('/admin/approving-order/{email}', 'AdminController@approvingorder');
Route::get('/admin/processing-order/{email}', 'AdminController@processingorder');
Route::get('/admin/delivering-order/{email}', 'AdminController@deliveringorder');

Route::get('/admin/pendingorders', 'AdminController@pendingorders');
Route::get('/admin/approvedorders', 'AdminController@approvedorders');
Route::get('/admin/processedorders', 'AdminController@processedorders');
Route::get('/admin/ondeliveryorders', 'AdminController@ondeliveryorders');


//Menu Controller
Route::get('/admin/add-fooditem', 'MenuController@category');
Route::post('/insert-fooditem', 'MenuController@store');
Route::get('/menu/edit/{id}', 'MenuController@edit');
Route::post('/menu/update/{id}', 'MenuController@update');
Route::get('/menu/delete/{id}', 'MenuController@delete');

//Order Controller
Route::post('/order', 'OrdersController@store');
Route::get('/customer-order', 'OrdersController@view');
Route::get('/order/delete/{id}', 'OrdersController@delete');
Route::get('/placeorder', 'OrdersController@placeOrder');
Route::post('/receiver', 'OrdersController@receiver');
Route::get('/myorder', 'OrdersController@myorder');





//category controller
Route::get('/admin/categories', 'CategoryController@index');
Route::get('/admin/add-category', 'CategoryController@create');
Route::post('/insert-category', 'CategoryController@store');
Route::get('/category/edit/{id}', 'CategoryController@edit');
Route::post('/category/update/{id}', 'CategoryController@update');
Route::get('/category/delete/{id}', 'CategoryController@delete');


