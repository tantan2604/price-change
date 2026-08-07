<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('users.login');
// });


Route::get('/users', [UserController::class, 'index']);
Route::get('/users-data', [UserController::class, 'getUsers']);

Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
Route::post('/updateUser', [UserController::class, 'updateUser'])->name('updateUser');
Route::post('/deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');


Route::get('/', [AuthController::class, 'loginForm'])->name('login');

Route::get('/', [AuthController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboardForm'])
    ->name('dashboard')
    ->middleware('auth');
