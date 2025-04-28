<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlertController; // Add this
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('sensors', SensorController::class);
    Route::get('/dashboard/overview', [\App\Http\Controllers\DashboardController::class, 'overview'])->name('dashboard.overview');
});

// Add these new routes
Route::resource('alerts', AlertController::class);
Route::resource('aqi_data', AqiDataController::class);