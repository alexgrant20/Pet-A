<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentScheduleController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\ServicePriceController;
use App\Http\Controllers\Admin\VeterinarianController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MedicationTypeController;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\VaccinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('app.admin.index'))->name('index');

Route::resource('veterinarian', VeterinarianController::class);
Route::get('/list/veterinarian', [VeterinarianController::class, 'getList'])->name('veterinarian.list');

Route::prefix('/master')
   ->name('master.')
   ->group(function () {
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

      Route::resource('vaccination', VaccinationController::class, ['parameters' => ['vaccination' => 'vaccination']]);
      Route::get('/list/vaccination', [VaccinationController::class, 'getList'])->name('list.vaccination');
   });

Route::resource('user-management', UserManagementController::class, ['parameters' => ['user-management' => 'user']]);
Route::get('/list/user-management/{roleId}', [UserManagementController::class, 'getList'])->name('user-management.list');
Route::prefix('/user-management')
   ->controller(UserManagementController::class)
   ->name('user-management.')
   ->group(function () {
      Route::get('/reset-password/{user}', 'resetPassword')->name('reset-password');
      Route::post('/reset-password/{user}/change', 'resetPasswordStore')->name('reset-password.change');
   });

Route::resource('service-price', ServicePriceController::class, ['parameters' => ['service-price' => 'servicePrice']]);
Route::get('/list/service-price', [ServicePriceController::class, 'getList'])->name('service-price.list');

Route::resource('clinic', ClinicController::class);
Route::get('/list/clinic', [ClinicController::class, 'getList'])->name('clinic.list');

Route::resource('appointment', AppointmentController::class)->only(['index', 'show', 'update', 'edit']);
Route::get('/list/appointment', [AppointmentController::class, 'getList'])->name('appointment.list');

Route::resource('appointment-schedule', AppointmentScheduleController::class, ['parameters' => ['appointment-schedule' => 'appointmentSchedule']])->except(['edit', 'update', 'show', 'destroy']);
Route::get('/list/appointment-schedule', [AppointmentScheduleController::class, 'getList'])->name('appointment-schedule.list');
Route::prefix('/appointment-schedule')
->controller(AppointmentScheduleController::class)
->name('appointment-schedule.')
->group(function() {
   Route::get('/{day}/edit', 'edit')->name('edit');
   Route::put('/{day}', 'update')->name('update');

   Route::delete('/{scheduleId}', 'destroy')->name('destroy');
});

Route::get('/chat/{sessionId}', [ChatController::class, 'adminChat'])->name('chat.show');
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
