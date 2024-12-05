<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetOwner\StoreAppointmentRequest;
use App\Jobs\SendReminderEmail;
use App\Models\Appointment;
use App\Models\AppointmentSchedule;
use App\Models\Notification;
use App\Models\PetType;
use App\Models\Rating;
use App\Models\ServiceType;
use App\Models\Veterinarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
         ->orderBy('is_cancelled', 'asc')
         ->orderBy('appointment_date', 'asc')
         ->get();

      $appointment->transform(function ($item) {
         $item->appointment_date_formatted = $item->appointment_date->format('Y-m-d');

         return $item;
      });

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
      $veterinarian->with([
         'user',
         'petType',
         'veterinarianServiceType.serviceType',
         'appointmentSchedule' => function ($query) {
            $query->where('is_active', 1);
         },
      ]);

      $serviceTypes = $veterinarian->veterinarianServiceType->pluck('serviceType')->pluck('name', 'id');
      $veterinarianActiveDate = $veterinarian->appointmentSchedule->pluck('day')->unique()->values();
      $allowedPetTypeId = $veterinarian->petType->pluck('id')->toArray();

      $pets = Auth::user()->profile->pet;
      $pets = $pets->filter(function ($pet) use ($allowedPetTypeId) {
         return in_array($pet->breed->pet_type_id, $allowedPetTypeId);
      });

      return view('app.pet-owner.appointment.create', compact('serviceTypes', 'pets', 'veterinarian', 'veterinarianActiveDate'));
   }

   public function store(StoreAppointmentRequest $request)
   {
      $veterinarian = Veterinarian::find($request->veterinarian_id);
      $appointmentSchedule = AppointmentSchedule::find($request->appointment_schedule_id);
      $serviceType = ServiceType::find($request->service_type_id);

      DB::beginTransaction();

      try {
         $petOwnerId = Auth::user()->profile_id;
         $veterinarianUserId = Veterinarian::find($request->veterinarian_id)->user->id;

         $appointment = Appointment::create([
            'pet_owner_id' => $petOwnerId,
            'pet_id' => $request->pet_id,
            'clinic_id' => $veterinarian->clinic_id,
            'service_type_id' => $request->service_type_id,
            'veterinarian_id' => $request->veterinarian_id,
            'appointment_schedule_id' => $request->appointment_schedule_id,
            'appointment_note' => $request->appointment_note,
            'appointment_date' => $request->appointment_date
         ]);

         $notification = Notification::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'title' => "{$serviceType->name} Appointment with {$veterinarian->user->name} at Clinic {$veterinarian->clinic->name}",
            'date_start' => $request->appointment_date . ' ' . $appointmentSchedule->start_time->format("H:i"),
            'link' => route('pet-owner.appointment.show', $appointment->id)
         ]);

         Notification::create([
            'user_id' => $veterinarianUserId,
            'title' => "You have new {$serviceType->name} appointment from " . Auth::user()->name . " on " . $appointment->appointment_date->format('F d, Y') . ' at ' . $appointmentSchedule->start_time->format("H:i"),
            'link' => route('admin.appointment.show', $appointment->id),
            'is_emailed' => true
         ]);

         SendReminderEmail::dispatch($notification);
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

   public function getAppointmentSchedule($veterinarianId, $date, $isToday)
   {
      $date = Carbon::parse($date);
      $now = now()->toTimeString();

      $appointmentSchedule = DB::table('appointment_schedules')
         ->selectRaw("TO_CHAR(start_time, 'HH24:MI') as formatted_time, *")
         ->where('veterinarian_id', $veterinarianId)
         ->where('day', $date->dayOfWeek + 1)
         ->when($isToday == "true", fn($q) => $q->where('start_time', '>', $now))
         ->orderBy('start_time')
         ->get();

      $appointmentDateFilter = Appointment::where('veterinarian_id', $veterinarianId)
         ->whereDate('appointment_date', $date)
         ->whereIn('appointment_schedule_id', $appointmentSchedule->pluck('id')->toArray())
         ->where('is_cancelled', false)
         ->pluck('appointment_schedule_id')
         ->toArray();

      return $appointmentSchedule
         ->filter(fn($el) => !in_array($el->id, $appointmentDateFilter))
         ->values()
         ->toArray();
   }

   public function giveRating(Request $request)
   {
      $appointment = Appointment::with('rating')->findOrFail($request->appointment_id);

      if (isset($appointment->rating)) abort(403);

      Rating::create([
         'appointment_id' => $appointment->id,
         'veterinarian_id' => $appointment->veterinarian_id,
         'rating' => $request->rating
      ]);

      return back()->with('success-swal', 'Successfully give rating');
   }

   public function cancel(Request $request)
   {
      $appointment = Appointment::where('id', $request->appointment_id)->where('pet_owner_id', auth()->user()->profile->id)->first();

      if (!$appointment) {
         abort(404);
      }

      $appointment->update([
         'is_cancelled' => true,
         'finished_at' => now()
      ]);

      Notification::where('link', route('pet-owner.appointment.show', $appointment->id))->delete();

      return to_route('pet-owner.appointment.index')->with('success-swal', 'Successfully cancelled appointment');
   }
}
