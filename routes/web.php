<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\OrderController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Checkout (Using guest-accessible placeholder for now)
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order/success', [OrderController::class, 'success'])->name('payment.success');

include 'admin.php';
