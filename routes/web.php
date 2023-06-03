<?php

use App\Http\Controllers\ChatRoomNotificationController;
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

const routes = [
    'confirm' => false,
    'reset' => false
];

Auth::routes(routes);

// Guest users
Route::middleware('guest')->group(function () {
    // Overwriting login forms
    if (routes['login'] ?? true) {
        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::inertia('/login', 'Auth/Login', [
            'lang.content.login' => __('content.login')
        ])->name('login');
    }

    // Overwriting register forms
    if (routes['register'] ?? true) {
        Route::inertia('/register', 'Auth/Register', [
            'lang.content.register' => __('content.register')
        ])->name('register');
    }
});

// Auth users
Route::middleware('auth')->group(function () {
    //Chat Room Notification
    Route::resource('chat-room-notifications', ChatRoomNotificationController::class)->only(['index', 'store']);

    //Users
    Route::resource('users', UserController::class)->only('index');
});
