<?php

use App\Http\Controllers\Auth\SocialAccountController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('index');
})->name('welcome');


Route::middleware('guest')
    ->group(function () {
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/login', [LoginController::class, 'attemptLogin'])->name('login.attempt');
        Route::get('login/{provider}', [SocialAccountController::class, 'redirectToProvider'])->name('login.social');
        Route::get('login/{provider}/callback', [SocialAccountController::class, 'handleProviderCallback']);
    });

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
