<?php

use App\Http\Controllers\PetAllergyController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetOwner\AppointmentController;
use App\Http\Controllers\PetOwner\AppointmentRequestController;
use App\Http\Controllers\PetOwner\HomeController;
use App\Http\Controllers\PetOwner\MedicalRecordController;
use App\Http\Controllers\PetOwner\OnlineConsultationController;
use App\Http\Controllers\PetOwner\ProfileController;
use App\Http\Controllers\PetOwner\VaccinationController;
use App\Http\Controllers\PetVaccinationController;
use App\Models\Appointment;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::resource('pet', PetController::class);
Route::get('/switch-pet-profile/{pet}', [PetController::class, 'switchPetProfile'])->name('pet.switch-pet-profile');
Route::get('/vaccination', [VaccinationController::class, 'index'])->name('vaccination.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/{petOwner}', [ProfileController::class, 'update'])->name('profile.update');

// Route::resource('/online-consultation', OnlineConsultationController::class);

Route::name('appointment.')
   ->controller(AppointmentController::class)
   ->group(function () {
      Route::get('/', 'index')->name('index');
      Route::get('/create/{appointment}', 'create')->name('create');
      Route::get('/list/appointment', 'getList')->name('list.appointment');
   });

Route::get('/medical-record', [MedicalRecordController::class, 'index'])->name('medical-record.index');

Route::name('pet-allergy.')
   ->controller(PetAllergyController::class)
   ->group(function () {
      Route::post('/pet-allergy', 'store')->name('store');
      Route::delete('/pet-allergy/{petAllergy}', 'destroy')->name('destroy');
   });

Route::name('pet-vaccination.')
   ->controller(PetVaccinationController::class)
   ->group(function () {
      Route::post('/pet-vaccination', 'store')->name('store');
      Route::delete('/pet-vaccination/{petVaccination}', 'destroy')->name('destroy');
   });
