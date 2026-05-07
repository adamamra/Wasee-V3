<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\OrganizationAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Organization\ProfileController as OrganizationProfileController;

// Authentication Routes
// User (guardian) auth uses guest middleware on default guard
Route::middleware('guest')->group(function () {
    // User Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // User Registration Routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Password Reset Routes
    Route::get('password/reset', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm')
        ->name('password.request');
    Route::post('password/email', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');
    Route::get('password/reset/{token}', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset')
        ->name('password.update');
});

// Organization Authentication Routes
Route::prefix('organization')->name('organization.')->group(function () {
    Route::middleware('guest:organization')->group(function () {
        // Organization Login Routes
        Route::get('/login', [OrganizationAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [OrganizationAuthController::class, 'login']);
        
        // Organization Registration Routes
        Route::get('/register', [OrganizationAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [OrganizationAuthController::class, 'register']);
    });

    // Organization Logout Route
    Route::post('/logout', [OrganizationAuthController::class, 'logout'])
        ->middleware('auth:organization')
        ->name('logout');
});

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Parcel Routes
Route::get('/parcels', [ParcelController::class, 'index'])->name('parcels.index');
Route::get('/parcels/{parcel}', [ParcelController::class, 'show'])->name('parcels.show');

// Protected Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    // User profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Parcel Management
    Route::resource('parcels', ParcelController::class)->except(['index', 'show']);
    
    // Organization Profile (for organization users)
    Route::middleware('auth:organization')->group(function () {
        Route::get('/organization/profile', [OrganizationProfileController::class, 'show'])
            ->name('organization.profile.show');
        Route::put('/organization/profile', [OrganizationProfileController::class, 'update'])
            ->name('organization.profile.update');
    });

    // Admin Routes
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

// Logout Route for Users
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Fallback Route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
