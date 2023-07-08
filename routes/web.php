<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as HttpStatus;

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

Route::get('/', function () {
    if (config('app.env') == 'local') {
        return view('welcome');
    }
    abort(HttpStatus::HTTP_NOT_FOUND);
});
