<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\ParcelController;

// Admin Dashboard
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

// User Management
Route::prefix('admin/users')->name('admin.users.')->middleware(['web'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}/approve', [UserController::class, 'approve'])
        ->name('approve');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

// Organization Management
Route::prefix('admin/organizations')->name('admin.organizations.')->middleware(['web'])->group(function () {
    Route::get('/', [OrganizationController::class, 'index'])->name('index');
    Route::patch('/{organization}/toggle-approval', [OrganizationController::class, 'toggleApproval'])
        ->name('toggle-approval');
    Route::delete('/{organization}', [OrganizationController::class, 'destroy'])->name('destroy');
});

// Parcel (Custody Request) Management
Route::prefix('admin/parcels')->name('admin.parcels.')->middleware(['web'])->group(function () {
    Route::get('/', [ParcelController::class, 'index'])->name('index');
    Route::get('/{parcel}', [ParcelController::class, 'show'])->name('show');
    Route::patch('/{parcel}/deliver', [ParcelController::class, 'deliver'])->name('deliver');
    Route::delete('/{parcel}', [ParcelController::class, 'destroy'])->name('destroy');
});
