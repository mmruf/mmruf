<?php
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoveController;
use Illuminate\Support\Facades\Route;

// 1. DASHBOARD PENGUNJUNG (Public)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/apps', [AppsController::class, 'index'])->name('apps.index');

Route::get('/apps/love', [LoveController::class, 'index'])->name('love.index');
Route::post('/apps/love/store', [LoveController::class, 'store'])->name('love.store');

// 2. AUTENTIKASI (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

// 3. ADMIN AREA (Protected)
Route::middleware('auth')->prefix('admin')->group(function () {
    // Halaman Dashboard Admin
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});