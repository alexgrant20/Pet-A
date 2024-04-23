<?php

use App\Http\Controllers\PetController;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
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
    $pets = Auth::user()->profile->pet;

    return view('app.pet-owner.index', compact('pets'));
})->name('index');

Route::resource('pet', PetController::class);