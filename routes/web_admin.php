<?php

use App\Http\Controllers\Admin\VeterinarianController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MedicationTypeController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\VaccinationTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('app.admin.index'))->name('index');

Route::resource('veterinarian', VeterinarianController::class);
Route::get('/list/veterinarian', [VeterinarianController::class, 'getList'])->name('veterinarian.list');

Route::prefix('/master')->name('master.')->group(function () {
	Route::resource('pet-type', PetTypeController::class, ['parameters' => ['pet-type' => 'petType']]);
	Route::get('/list/pet-type', [PetTypeController::class, 'getList'])->name('list.pet-type');

	Route::resource('breed', BreedController::class);
	Route::get('/list/breed', [BreedController::class, 'getList'])->name('list.breed');

	Route::resource('city', CityController::class);
	Route::get('/list/city', [CityController::class, 'getList'])->name('list.city');

	Route::resource('province', ProvinceController::class);
	Route::get('/list/province', [ProvinceController::class, 'getList'])->name('list.province');

	Route::resource('appointment-type', AppointmentTypeController::class, ['parameters' => ['appointment-type' => 'appointmentType']]);
	Route::get('/list/appointment-type', [AppointmentTypeController::class, 'getList'])->name('list.appointment-type');

	Route::resource('medication-type', MedicationTypeController::class, ['parameters' => ['medication-type' => 'medicationType']]);
	Route::get('/list/medication-type', [MedicationTypeController::class, 'getList'])->name('list.medication-type');

	Route::resource('payment-type', PaymentTypeController::class, ['parameters' => ['payment-type' => 'paymentType']]);
	Route::get('/list/payment-type', [PaymentTypeController::class, 'getList'])->name('list.payment-type');

	Route::resource('vaccination-type', VaccinationTypeController::class, ['parameters' => ['vaccination-type' => 'vaccinationType']]);
	Route::get('/list/vaccination-type', [VaccinationTypeController::class, 'getList'])->name('list.vaccination-type');
});
