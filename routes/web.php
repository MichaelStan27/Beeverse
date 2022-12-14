<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
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
            Route::post('/hidden/confirm', 'confirmHidden')->name('confirm_hidden');
            Route::get('/hidden/confirm', 'viewError');
            Route::post('/hidden/{user}', 'makeHidden')->name('make_hidden');
            Route::get('/hidden/{user}', 'viewError');
            Route::post('/visible/confirm', 'confirmVisible')->name('confirm_visible');
            Route::get('/visible/confirm', 'viewError');
            Route::post('/visible/{user}/choose', 'chooseVisible')->name('choose_visible');
            Route::get('/visible/{user}/choose', 'viewError')->name('choose_visible');
            Route::post('/visible/{user}', 'makeVisible')->name('make_visible');
            Route::get('/visible/{user}', 'viewError');
            Route::post('/choose/{user}', 'chooseAvatar')->name('choose_avatar');
            Route::get('/choose/{user}', 'viewError');
            Route::post('/change/{user}', 'changeAvatar')->name('change_avatar');
            Route::get('/change/{user}', 'viewError');
            Route::post('/{user}/add', 'addFriend')->name('add_friend');
            Route::get('/{user}/profile', 'index')->name('profile');
            Route::post('/{user}/profile/tabfollowing', 'tabFollowing')->name('tab_following');
            Route::post('/{user}/profile/tabfollowers', 'tabFollowers')->name('tab_followers');
        });

        Route::controller(ChatController::class)->group(function () {
            Route::get('/chats', 'index')->name('list_chat');
            Route::get('/chat/{user}/{room}', 'viewChat')->name('chat');
            Route::post('/chat/{user}/{room}', 'sendChat');
        });
    });
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::get('/search', 'search')->name('search');
});

Route::controller(LanguageController::class)->group(function () {
    Route::post('/changeLang/{lang}', 'changeLang')->name('change_lang');
    Route::get('/changeLang/{lang}', 'viewError');
});
