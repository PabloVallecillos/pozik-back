<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [UserController::class, 'login'])
    ->middleware(['throttle:6,1'])
    ->name('user.login');

Route::post('register', [UserController::class, 'register'])
    ->middleware(['throttle:10,1'])
    ->name('user.register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('user', [UserController::class, 'user'])->name('user.user');
});
