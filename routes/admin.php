<?php

use App\Http\Controllers\Auth\AuthSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [LoginController::class, 'adminLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'adminLoginStore'])->name('login.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AuthSettingController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile/update', [AuthSettingController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::post('/password/update', [AuthSettingController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'updateSettings'])->name('settings.update');
});
