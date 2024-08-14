<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetOwner\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentSchedule;
use App\Models\Notification;
use App\Models\PetType;
use App\Models\ServicePrice;
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
   public function index(Request $request)
   {
      $name = strtolower($request->name);
      $petTypeId = $request->pet_type_id;

      $veterinarians = Veterinarian::with('user', 'petType', 'attachment')
      ->whereRelation('user', function ($q) use($name) {
         $q->whereRaw("LOWER(name) LIKE '%$name%'");
      })
      ->when($petTypeId, fn($q) => $q->whereRelation('petType', 'pet_types.id', $petTypeId))
      ->paginate(6);

      $petTypes = PetType::all();

      return view('app.pet-owner.appointment.index', compact('veterinarians', 'petTypes'));
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
      $veterinarian->load('user', 'veterinarianServiceType.serviceType', 'appointmentSchedule');

      $serviceTypes = $veterinarian->veterinarianServiceType->pluck('serviceType')->pluck('name', 'id');

      $veterinarianActiveDate = $veterinarian->appointmentSchedule->pluck('day')->unique()->values();

      $pets = Auth::user()->profile->pet;
      return view('app.pet-owner.appointment.create', compact('serviceTypes', 'pets', 'veterinarian', 'veterinarianActiveDate'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreAppointmentRequest $request)
   {
      $veterinarian = Veterinarian::find($request->veterinarian_id);

      Notification::create([
         'user_id' => Auth::id(),
         'pet_id' => $request->pet_id,
         'title' => "Appointment with {$veterinarian->user->name}",
         'date_start' => $request->appointment_date
      ]);

      $petOwnerId = Auth::user()->profile_id;

      Appointment::create([
         'pet_owner_id' => $petOwnerId,
         'pet_id' => $request->pet_id,
         'clinic_id' => $veterinarian->clinic_id,
         'service_type_id' => $request->service_type_id,
         'veterinarian_id' => $request->veterinarian_id,
         'appointment_schedule_id' => $request->appointment_schedule_id,
         'appointment_note' => $request->appointment_note,
         'appointment_date' => $request->appointment_date
      ]);

      return response()->json();
   }

   /**
    * Display the specified resource.
    */
   public function show(Appointment $appointment)
   {
      $appointment->load('serviceType', 'veterinarian', 'appointmentSchedule', 'pet');


      return view('app.pet-owner.appointment.show', compact('appointment', 'servicePrice'));
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

   public function getAppointmentSchedule($veterinarianId, $day)
   {
      return AppointmentSchedule::where([
         ['veterinarian_id', $veterinarianId],
         ['day', $day]
      ])->get();
   }
}
