<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/initialize', [AuthController::class, 'initialize'])->name('initialize');
    Route::post('/initialize', [AuthController::class, 'initialize']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/tasks', TaskController::class);

    Route::prefix('/users')->group(function () {
        Route::get('/order', [UserController::class, 'order'])->name('users.order');
        Route::post('/order', [UserController::class, 'order']);
    });
});
