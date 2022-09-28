<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/cc', function () {
    Artisan::call('cache:clear');
    echo '<script>alert("cache clear Success")</script>';
});
Route::get('/ccc', function () {
    Artisan::call('config:cache');
    echo '<script>alert("config cache Success")</script>';
});
Route::get('/cccc', function () {
    Artisan::call('config:clear');
    echo '<script>alert("config clear Success")</script>';
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('/home');
    }
    return view('auth.login');
});

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers'], function ($admins) {
    Route::get('/', function () {
        return view('auth/login', ['pagetitle' => 'Login']);
    });
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('login');
    $admins->middleware(['auth:web'])->group(function ($userroute) {
        $userroute->get('/home', [HomeController::class, 'index'])->name('home');
        $userroute->resource('product', ProductController::class);
        $userroute->get('product-detail/{id}', [ProductController::class, 'userProductDetail'])->name('product-detail');
        
        $userroute->get('cart', [ProductController::class, 'cart'])->name('cart');
        $userroute->get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add-to-cart');
        $userroute->patch('update-cart', [ProductController::class, 'updatecart'])->name('update-cart');
        $userroute->delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove-from-cart');

        $userroute->get('checkout', [ProductOrderController::class, 'index'])->name('checkout');
        $userroute->get('checkout-process', [ProductOrderController::class, 'checkoutProcess'])->name('checkout-process');

        $userroute->get('user-order-list', [ProductOrderController::class, 'userOrderList'])->name('user-order-list');
        $userroute->get('top-selling-product', [ProductOrderController::class, 'topSellingProduct'])->name('top-selling-product');

        $userroute->get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
        $userroute->post('stripes', [StripePaymentController::class, 'stripePost'])->name('stripes');

        $userroute->get('/admin', [HomeController::class, 'admindashboard'])->name('admin');
    });
});
