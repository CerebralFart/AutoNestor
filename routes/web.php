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
    Route::prefix('/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'list'])->name('tasks');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/create', [TaskController::class, 'create']);
        Route::get('/{id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/{id}/edit', [TaskController::class, 'update'])->name('tasks.update');
        Route::post('/{id}/edit', [TaskController::class, 'update']);
        Route::post('/{id}/delete', [TaskController::class, 'delete'])->name('tasks.delete');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'create']);
        Route::get('/order', [UserController::class, 'order'])->name('users.order');
        Route::post('/order', [UserController::class, 'order']);
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'update'])->name('users.update');
        Route::post('/{id}/edit', [UserController::class, 'update']);
        Route::post('/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    });
});
