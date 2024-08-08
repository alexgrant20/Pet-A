<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ServiceType;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $veterinarians = Veterinarian::with('user', 'petType', 'attachment')->get();

      return view('app.pet-owner.appointment.index', compact('veterinarians'));
   }

   public function getList()
   {
      $appointments = Appointment::where('pet_owner_id', Auth::user()->profile->id)
         ->with('veterinarian.user', 'clinic', 'serviceType', 'pet')
         ->get();

      return DataTables::of($appointments)
         ->addIndexColumn()
         ->make();
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create(Veterinarian $veterinarian)
   {
      $serviceTypes = ServiceType::all();
      $pets = Auth::user()->profile->pet;
      return view('app.pet-owner.appointment.create', compact('serviceTypes', 'pets'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    */
   public function show(Appointment $medicalRecord)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Appointment $medicalRecord)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Appointment $medicalRecord)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Appointment $medicalRecord)
   {
      //
   }
}
