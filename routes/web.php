<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::middleware('guest')->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'validation');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login');
    });
});


Route::middleware('auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/{user}/payment', 'viewPayment')->name('payment');
        Route::post('/{user}/payment', 'checkPayment');
        Route::post('/{user}/convert', 'convert')->name('convert');
        Route::post('/logout', 'logout')->name('logout');
    });
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});
