<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\SupportController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Checkout (Using guest-accessible placeholder for now)
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order/success', [OrderController::class, 'success'])->name('payment.success');

// Static Pages
Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [SupportController::class, 'contactStore'])->name('contact.store');

include 'admin.php';
