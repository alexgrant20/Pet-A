<?php

use App\Http\Controllers\Auth\SocialAccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
  return view('app.index');
})->name('welcome');


Route::middleware('guest')
  ->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'attemptLogin'])->name('login.attempt');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('login/{provider}', [SocialAccountController::class, 'redirectToProvider'])->name('login.social');
    Route::get('login/{provider}/callback', [SocialAccountController::class, 'handleProviderCallback']);
  });

Route::middleware('auth')->group(function () {
  Route::get('/home', function () {
    $isPetOwner = auth()->user()->roles->first()->id == 1;

    if ($isPetOwner) return to_route('pet-owner.index');
    return to_route('admin.index');
  })->name('home');
  Route::get('logout', [LoginController::class, 'logout'])->name('logout');

  Route::prefix('master')
    ->name('master.')
    ->group(function () {
      Route::get('/breed/{pet_type_id}', [MasterController::class, 'getBreed'])->name('breed');
      Route::get('/vaccination/{pet_type_id}', [MasterController::class, 'getVaccination'])->name('vaccination');
      Route::post('/city', [MasterController::class, 'getCity'])->name('city');
    });
});
