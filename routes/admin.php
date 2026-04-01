<?php

use App\Http\Controllers\Auth\AuthSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [LoginController::class, 'adminLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'adminLoginStore'])->name('login.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AuthSettingController::class, 'adminProfile'])->name('profile');
    Route::post('/profile/update', [AuthSettingController::class, 'adminProfileUpdate'])->name('profile.update');
    Route::post('/password/update', [AuthSettingController::class, 'adminPasswordUpdate'])->name('password.update');

    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'updateSettings'])->name('settings.update');

    // FAQ Management
    Route::resource('faq', FaqController::class);
    
    // Contact Inquiries
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}/read', [ContactController::class, 'read'])->name('contacts.read');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Slider Management
    Route::resource('sliders', SliderController::class);

    // User Management
    Route::resource('users', UserController::class);

    // Order Management
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('order.status');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
});
