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
use App\Menu;
use App\Category;
use App\CustomerReview;
use App\Events\Notif;
Route::get('/', function (Request $request) {
   echo $uri = request()->segment(2);

    $categories = Category::orderBy('category')->get();
    $menus = Menu::orderBy('food_name')->get();
    $reviews = CustomerReview::orderBy('customer_name')->get();
    return view('welcome',compact('menus','categories','reviews','uri'));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/menu/{category}', 'HomeController@menu_nav');
Route::get('/order-history/{email}', 'HomeController@orderHistory');
Route::get('/view/history-orders/{id}/{email}', 'HomeController@view_orderHistory');
//Route::get('/unread_message', 'HomeController@unread_message');
Route::get('/messages', 'HomeController@messages');
Route::get('/mark-asread/{id}', 'HomeController@mark_asread');
Route::get('/terms&conditions', 'HomeController@termsnconditions');


Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
//admin controller
Route::get('/dashboard', 'AdminController@index');
Route::get('/admin/menu', 'AdminController@menu');
Route::get('/admin/messages', 'AdminController@messages');
Route::get('/admin/orders', 'AdminController@orders');
Route::get('/admin/sales', 'AdminController@sales');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/pending-order/{email}', 'AdminController@filtered_pendingorders');
Route::get('/admin/approve-order/{email}', 'AdminController@filtered_approveorders');
Route::get('/admin/process-order/{email}', 'AdminController@filtered_processorders');
Route::get('/admin/ondelivery-order/{email}', 'AdminController@filtered_ondeliveryorders');
Route::get('/admin/customer-cancelled-order/{id}', 'AdminController@filtered_cancelledorders');
Route::get('/admin/received-order/{id}/{email}', 'AdminController@filtered_receivedorders');
Route::get('/view/summary-orders/{id}/{email}', 'AdminController@view_summary');
Route::post('/receipt/pdf/{email}/{id}', 'AdminController@generateReceipt');
Route::get('/print', 'AdminController@print');
Route::post('/decline-order/{order_id}/{email}', 'AdminController@decline_order');
Route::get('/admin/gcash', 'AdminController@gcash_config');
Route::post('/gcash-upload', 'AdminController@gcash_store');
Route::post('/gcash-update/{id}', 'AdminController@gcash_update');



Route::get('/admin/approving-order/{order_id}/{email}', 'AdminController@approvingorder');
Route::get('/admin/processing-order/{order_id}/{email}', 'AdminController@processingorder');
Route::get('/admin/delivering-order/{order_id}/{email}', 'AdminController@deliveringorder');
Route::get('/admin/receiving-order/{id}/{email}', 'AdminController@receivingorder');
Route::get('/admin/receipts', 'AdminController@receipts');
Route::get('/admin/customer-receipts/{id}/{email}', 'AdminController@customer_receipts');
Route::get('/admin/view-receipt/{receipt_name}', 'AdminController@view_receipt');


Route::get('/admin/pendingorders', 'AdminController@pendingorders');
Route::get('/admin/approvedorders', 'AdminController@approvedorders');
Route::get('/admin/processedorders', 'AdminController@processedorders');
Route::get('/admin/ondeliveryorders', 'AdminController@ondeliveryorders');
Route::get('/admin/receivedorders', 'AdminController@receivedorders');
Route::get('/admin/cancelledorders', 'AdminController@cancelledorders');

//Menu Sales
Route::get('/menu/sales/{id}', 'AdminController@filtered_menusales');

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
Route::post('/customer-message', 'OrdersController@customerMessage');
Route::get('/receiver_page', 'OrdersController@receiver_page');
Route::get('/myorder', 'OrdersController@myorder');
Route::get('/cancel-order/{email}/{id}', 'OrdersController@cancelOrder');
Route::get('/my-cancelled-orders/{email}', 'OrdersController@mycancelledOrders');
Route::get('/view/cancelled-orders/{id}/{email}', 'OrdersController@cancelled_orderHistory');






//category controller
Route::get('/admin/categories', 'CategoryController@index');
Route::get('/admin/add-category', 'CategoryController@create');
Route::post('/insert-category', 'CategoryController@store');
Route::get('/category/edit/{id}', 'CategoryController@edit');
Route::post('/category/update/{id}', 'CategoryController@update');
Route::get('/category/delete/{id}', 'CategoryController@delete');

//User Controller
Route::get('/admin/deactivate_account/{id}', 'AdminController@deactivate_account');
Route::get('/admin/activate_account/{id}', 'AdminController@activate_account');

//Customer Review Form
Route::get('/review-form', 'HomeController@customer_review');
Route::post('/insert-reviewform', 'HomeController@insert_review');

//Account Settings Controller
Route::get('/account-settings', 'AccountController@account_settings');
Route::post('/edit-accountdetails', 'AccountController@edit_accountdetails');

//GCASH


