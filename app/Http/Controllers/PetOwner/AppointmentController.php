<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetOwner\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentSchedule;
use App\Models\Notification;
use App\Models\PetType;
use App\Models\Rating;
use App\Models\ServicePrice;
use App\Models\ServiceType;
use App\Models\Veterinarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
         ->whereRelation('user', function ($q) use ($name) {
            $q->whereRaw("LOWER(name) LIKE '%$name%'");
         })
         ->when($petTypeId, fn($q) => $q->whereRelation('petType', 'pet_types.id', $petTypeId))
         ->paginate(6);

      $petTypes = PetType::all();
      $appointment = Appointment::with('pet', 'veterinarian.user', 'appointmentSchedule', 'rating')
         ->where('pet_owner_id', auth()->user()->profile->id)
         ->get();

      return view('app.pet-owner.appointment.index', compact('veterinarians', 'petTypes', 'name', 'appointment'));
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

   public function create(Veterinarian $veterinarian)
   {
      $veterinarian->load('user', 'veterinarianServiceType.serviceType', 'appointmentSchedule');

      $serviceTypes = $veterinarian->veterinarianServiceType->pluck('serviceType')->pluck('name', 'id');

      $veterinarianActiveDate = $veterinarian->appointmentSchedule->pluck('day')->unique()->values();

      $pets = Auth::user()->profile->pet;
      return view('app.pet-owner.appointment.create', compact('serviceTypes', 'pets', 'veterinarian', 'veterinarianActiveDate'));
   }

   public function store(StoreAppointmentRequest $request)
   {
      $veterinarian = Veterinarian::find($request->veterinarian_id);
      $appointmentSchedule = AppointmentSchedule::find($request->appointment_schedule_id);

      DB::beginTransaction();

      try {
         Notification::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'title' => "Appointment with {$veterinarian->user->name}",
            'date_start' => $request->appointment_date . ' ' . $appointmentSchedule->start_time
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
      } catch (\Exception $e) {
         DB::rollBack();

         return back()->with('error-swal', 'Something went wrong');
      }

      DB::commit();

      return to_route('pet-owner.index')->with('success-swal', 'Appointment successfully created!');
   }

   public function show(Appointment $appointment)
   {
      $appointment->load('serviceType', 'veterinarian', 'appointmentSchedule', 'pet');

      return view('app.pet-owner.appointment.show', compact('appointment'));
   }

   public function getAppointmentSchedule($veterinarianId, $date)
   {
      $date = Carbon::parse($date);

      $appointmentSchedule =  AppointmentSchedule::where([
         ['veterinarian_id', $veterinarianId],
         ['day', $date->dayOfWeek + 1]
      ])->get();

      $appointmentDateFilter = Appointment::where('veterinarian_id', $veterinarianId)
         ->whereDate('appointment_date', $date)
         ->whereIn('appointment_schedule_id', $appointmentSchedule->pluck('id')->toArray())
         ->pluck('appointment_schedule_id')
         ->toArray();

      return $appointmentSchedule->reject(fn($el) => in_array($el->id, $appointmentDateFilter));
   }

   public function giveRating(Request $request)
   {
      $appointment = Appointment::with('rating')->findOrFail($request->appointment_id);

      if(isset($appointment->rating)) abort(403);

      Rating::create([
         'appointment_id' => $appointment->id,
         'veterinarian_id' => $appointment->veterinarian_id,
         'rating' => $request->rating
      ]);

      return back()->with('success-swal', 'Berhasil Membuat Rating');
   }
}
