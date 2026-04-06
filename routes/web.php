<?php

use App\Http\Controllers\Frontend\Auth\UserAuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SupportController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::get('/order/success', [OrderController::class, 'success'])->name('payment.success');

// UddoktaPay Routes
Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('uddoktapay.success');
Route::get('/payment/cancel', [OrderController::class, 'paymentCancel'])->name('uddoktapay.cancel');
Route::post('/payment/webhook', [OrderController::class, 'webhook'])->name('uddoktapay.webhook');

// Static Pages
Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [SupportController::class, 'contactStore'])->name('contact.store');

Route::view('/privacy-policy', 'Frontend.pages.privacy')->name('privacy');
Route::view('/terms-of-service', 'Frontend.pages.terms')->name('terms');
Route::view('/cookie-policy', 'Frontend.pages.cookie')->name('cookie');

// Authentication (User)
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-orders', [DashboardController::class, 'orders'])->name('orders.index');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    include 'admin.php';
});
