<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PriceChangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// ==========================================================================
// Users
// ==========================================================================

Route::get('/users', [UserController::class, 'index']);

Route::get('/users-data', [UserController::class, 'getUsers']);

Route::post('/addUser', [UserController::class, 'addUser'])
    ->name('addUser');

Route::post('/updateUser', [UserController::class, 'updateUser'])
    ->name('updateUser');

Route::post('/deleteUser', [UserController::class, 'deleteUser'])
    ->name('deleteUser');


// ==========================================================================
// Authentication
// ==========================================================================

Route::get('/', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==========================================================================
// Dashboard
// ==========================================================================

Route::get('/dashboard', [AuthController::class, 'dashboardForm'])
    ->name('dashboard')
    ->middleware('auth');


// ==========================================================================
// Price Changes
// ==========================================================================

Route::get(
    '/price_change',
    [PriceChangeController::class, 'create']
)->name('price_change');

Route::post(
    '/price-changes',
    [PriceChangeController::class, 'store']
)->name('price-changes.store');

Route::get(
    '/price-change-data',
    [PriceChangeController::class, 'getPriceChanges']
)->name('price-changes.data');


// ==========================================================================
// Product Import
// ==========================================================================

Route::post(
    '/products/import',
    [ProductController::class, 'import']
)->name('products.import');