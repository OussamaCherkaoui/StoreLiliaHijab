<?php


use Illuminate\Support\Facades\Route;

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

//login logout & register routes
Auth::routes();

//home route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//activate user account routes
Route::get('/activate/{code}','App\Http\Controllers\ActivationController@activateUserAccount')->name('user.activate');
Route::get('/resend/{email}', 'App\Http\Controllers\ActivationController@resendActivationCode')->name('code.resend');
//products routes
Route::resource('products','App\Http\Controllers\ProductController');
Route::get('products/category/{category}', 'App\Http\Controllers\HomeController@getProductByCategory')->name("category.products");
//cart routes
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/add/cart/{product}', 'App\Http\Controllers\CartController@addProductToCart')->name('add.cart');
Route::delete('/remove/{product}/cart', 'App\Http\Controllers\CartController@removeProductFromCart')->name('remove.cart');
Route::put('/update/{product}/cart', 'App\Http\Controllers\CartController@updateProductOnCart')->name('update.cart');
//payment routes
Route::get('/handle-payment', 'App\Http\Controllers\PaypalPaymentController@handlePayment')->name('make.payment');
Route::get('/cancel-payment', 'App\Http\Controllers\PaypalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('/payment-success', 'App\Http\Controllers\PaypalPaymentController@paymentSuccess')->name('success.payment');
//admin routes
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
Route::get('/admin/login', 'App\Http\Controllers\AdminController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'App\Http\Controllers\AdminController@adminLogin')->name('admin.login');
Route::get('/admin/logout', 'App\Http\Controllers\AdminController@adminLogout')->name('admin.logout');
Route::get('/admin/products', 'App\Http\Controllers\AdminController@getProducts')->name('admin.products');
Route::get('/admin/orders', 'App\Http\Controllers\AdminController@getOrders')->name('admin.orders');
//orders routes
Route::resource('orders', 'App\Http\Controllers\OrderController');