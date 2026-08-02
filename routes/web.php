<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\BiodataController;
use App\Http\Controllers\Public\LifeEventController as PublicLifeEventController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\LifeYearController;
use App\Http\Controllers\Admin\LifeEventController as AdminLifeEventController;

// --------------------------------------------------------------------------
// 1. ROUTE AUTENTIKASI (LOGIN & LOGOUT)
// --------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Redirect Root URL secara dinamis berdasarkan role
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('public.home');
    }
    return redirect()->route('login');
});

// --------------------------------------------------------------------------
// 2. ROUTE PUBLIC / BIODATA (Akses Membutuhkan Role: guest / admin)
// --------------------------------------------------------------------------
Route::middleware(['auth', 'role:guest,admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('public.home');

    // Menu Utama Biodata
    Route::get('/biodata', [BiodataController::class, 'index'])->name('public.biodata.index');
    Route::get('/biodata/perkenalan', [BiodataController::class, 'profile'])->name('public.biodata.profile');
    Route::get('/biodata/pendidikan', [BiodataController::class, 'educations'])->name('public.biodata.educations');
    Route::get('/biodata/pekerjaan', [BiodataController::class, 'experiences'])->name('public.biodata.experiences');

    // Life Events Public
    Route::get('/life-events', [PublicLifeEventController::class, 'index'])->name('public.life-events.index');
    Route::get('/life-events/{lifeEvent}', [PublicLifeEventController::class, 'show'])->name('public.life-events.show');
});

// --------------------------------------------------------------------------
// 3. ROUTE ADMIN (Khusus Membutuhkan Role: admin)
// --------------------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile Admin
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    // Master Data CRUD
    Route::resource('educations', AdminEducationController::class)->except(['show']);
    Route::resource('experiences', AdminExperienceController::class)->except(['show']);
    Route::resource('life-years', LifeYearController::class);
    Route::resource('life-events', AdminLifeEventController::class);

    // Delete photo individual
    Route::delete('life-event-photos/{photo}', [AdminLifeEventController::class, 'destroyPhoto'])
        ->name('life-event-photos.destroy');
});