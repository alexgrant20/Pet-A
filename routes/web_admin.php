<?php

use App\Http\Controllers\PetTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('app.admin.index'))->name('index');

Route::resource('petType', PetTypeController::class);
Route::get('/list/pet-type', [PetTypeController::class, 'getList'])->name('list.pet-type');