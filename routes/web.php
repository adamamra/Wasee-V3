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

// Organization auth routes are independent so you can be logged in as a user and as an organization in the same browser session
Route::get('/organization/login', [OrganizationAuthController::class, 'showLoginForm'])
    ->name('organization.login');
Route::post('/organization/login', [OrganizationAuthController::class, 'login']);

Route::get('/organization/register', [OrganizationAuthController::class, 'showRegistrationForm'])
    ->name('organization.register');
Route::post('/organization/register', [OrganizationAuthController::class, 'register'])
    ->middleware('web');

// Logout Routes
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/organization/logout', [OrganizationAuthController::class, 'logout'])->name('organization.logout');

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    require __DIR__.'/admin.php';
});

// Organization Dashboard & Profile Routes
Route::middleware(['auth:organization'])->prefix('organization')->name('organization.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Organization\DashboardController::class, 'index'])
        ->name('dashboard');
        
    // Search for parcels
    Route::get('/parcels/search', [\App\Http\Controllers\Organization\DashboardController::class, 'search'])
        ->name('parcels.search');
        
    // Update parcel status
    Route::patch('/parcels/{parcel}/status', [\App\Http\Controllers\Organization\DashboardController::class, 'updateStatus'])
        ->name('parcels.update-status');
        
    // Delivered parcels
    Route::get('/delivered-parcels', [\App\Http\Controllers\Organization\DeliveredParcelsController::class, 'index'])
        ->name('delivered-parcels.index');
        
    // Export pending parcels
    Route::get('/parcels/export-pending', [\App\Http\Controllers\Organization\DeliveredParcelsController::class, 'exportPendingParcels'])
        ->name('parcels.export-pending');

    // Organization profile
    Route::get('/profile', [OrganizationProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [OrganizationProfileController::class, 'update'])->name('profile.update');
});

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    // User profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // My parcels (custody requests)
    Route::get('/my-parcels', [\App\Http\Controllers\UserParcelsController::class, 'index'])->name('parcels.my');

    // Parcel Routes
    Route::prefix('parcels')->group(function () {
        // Create new parcel form - must come before parameterized routes
        Route::get('/create', [ParcelController::class, 'create'])->name('parcels.create');
        
        // Deliver form - must come before parameterized routes
        Route::get('/deliver', [ParcelController::class, 'deliverForm'])->name('parcels.deliver-form');
        
        // Store new parcel
        Route::post('/', [ParcelController::class, 'store'])->name('parcels.store');
        
        // Process delivery
        Route::post('/{serial_number}/deliver', [ParcelController::class, 'deliver'])->name('parcels.deliver');
        
        // Show parcel details (handles both direct access and search)
        Route::get('/{serial_number?}', [ParcelController::class, 'show'])
            ->name('parcels.show')
            ->where('serial_number', '.*');
    });
});

// Public Organization Routes
Route::get('/organizations', [\App\Http\Controllers\OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organizations/{organization}', [\App\Http\Controllers\OrganizationController::class, 'show'])->name('organizations.show');
