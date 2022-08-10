<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
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

    Route::group(['middleware' => 'can:see'], function () {
        Route::controller(ShopController::class)->group(function () {
            Route::get('/shop', 'index')->name('shop');
            Route::post('/shop/{avatar}', 'checkBuy')->name('check');
            Route::post('/shop/{avatar}/confirm', 'confirmBuy')->name('confirm');
            Route::get('/shop/{avatar}/checksend', 'checkSend')->name('check_send');
            Route::post('/buy/{user}', 'buy')->name('buy_avatar');
            Route::get('/buy', 'viewError');
            Route::post('/send/{user}', 'send')->name('send_avatar');
            Route::get('/send/{user}', 'viewError');
        });
        Route::controller(ProfileController::class)->group(function () {
            Route::post('/topup/{user}', 'topup')->name('topup');
            Route::get('/topup/{user}', 'viewError');
        });
    });
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/{user}/profile', 'index')->name('profile');
});
