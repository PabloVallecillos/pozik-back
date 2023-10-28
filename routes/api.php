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
    ->middleware(['throttle:10,1'])
    ->name('user.login');

Route::post('register', [UserController::class, 'register'])
    ->middleware(['throttle:10,1'])
    ->name('user.register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
        Route::get('logged', [UserController::class, 'logged'])->name('logged');
        Route::get('recovery-password', [UserController::class, 'recoveryPassword'])
            ->middleware(['throttle:10,1'])
            ->name('recovery-password');
        Route::put('change-password', [UserController::class, 'changePassword'])
            ->middleware(['throttle:10,1'])
            ->name('change-password');
        Route::patch('update/{user?}', [UserController::class, 'update'])->name('update');
    });
});
