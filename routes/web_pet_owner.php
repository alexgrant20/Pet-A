<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\PetOwner\AppointmentController;
use App\Http\Controllers\PetOwner\MedicalRecordController;
use App\Http\Controllers\PetOwner\OnlineConsultationController;
use App\Http\Controllers\PetOwner\ProfileController;
use App\Http\Controllers\PetOwner\VaccinationController;
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
Route::get('/vaccination', [VaccinationController::class, 'index'])->name('vaccination.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/{petOwner}', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('/online-consultation', OnlineConsultationController::class);
Route::resource('/appointment', AppointmentController::class);
Route::get('/medical-record',[MedicalRecordController::class, 'index'])->name('medical-record.index');
