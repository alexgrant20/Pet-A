<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAppointmentRequest;
use App\Interfaces\AppointmentTypeInterface;
use App\Interfaces\ServiceTypeInterface;
use App\Models\AllergyCategory;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Notification;
use App\Models\PetVaccination;
use App\Models\PetWeight;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller implements ServiceTypeInterface
{
   public function index($isActive = 1)
   {
      $appointments = Appointment::with([
         'appointmentSchedule',
         'serviceType',
         'pet.breed.petType',
         'petOwner' => function ($q) {
            $q->with('user');
         },
      ])
         ->where('veterinarian_id', Auth::user()->profile_id)
         ->when($isActive == 1, function ($q) {
            $q->whereNull('finished_at');
         })
         ->when($isActive == 0, function ($q) {
            $q->whereNotNull('finished_at');
         })
         ->get();

      return view('app.admin.appointment.index', compact('appointments', 'isActive'));
   }

   public function getList()
   {
      if (!request()->ajax()) abort(404);

      $appointments = Appointment::with([
         'serviceType',
         'pet.breed.petType',
         'petOwner' => function ($q) {
            $q->with('user');
         },
      ])
         ->where('veterinarian_id', Auth::user()->profile_id)
         ->whereNull('finished_at')
         ->get();

      return DataTables::of($appointments)
         ->addIndexColumn()
         ->addColumn('pet_owner_name', function ($data) {
            return $data->petOwner->user->name;
         })
         ->addColumn('pet_type', function ($data) {
            return ucfirst($data->pet->breed->petType->name);
         })
         ->addColumn('appointment_type', function ($data) {
            return $data->serviceType->name;
         })
         ->addColumn('appointment_date', function ($data) {
            return (new Carbon($data->appointment_date))->translatedFormat("l, d F Y");
         })
         ->addColumn('appointment_schedule', function ($data) {
            $appointmentSchedule = $data->appointmentSchedule;
            $startTime = (new Carbon($appointmentSchedule->start_time))->translatedFormat("H:i");

            return "$startTime";
         })
         ->addColumn('action', function ($data) {
            return view('app.admin.appointment.components.__action', compact('data'))->render();
         })
         ->make();
   }

   public function show(Appointment $appointment)
   {
      $appointment->load([
         'serviceType',
         'pet' => function ($q) {
            $q->with([
               'petAllergy.icon',
               'petAllergy.allergyCategory',
               'attachment',
               'breed.petType',
               'medicalRecord.appointment',
               'petVaccination.vaccination'
            ]);
         },
         'petOwner' => function ($q) {
            $q->with('user', 'attachment', 'city', 'province');
         },
      ]);

      $petOwnerAddress = [
         $appointment->petOwner->user->address,
         $appointment->petOwner->city?->name,
         $appointment->petOwner->province?->name
      ];

      $allergyCategories = AllergyCategory::get();
      $petOwnerAddress = array_filter($petOwnerAddress, fn($value) => !is_null($value) && $value !== '');

      $appointment->petOwner->address = implode(", ", $petOwnerAddress);
      $lastPetWeight = $appointment->pet->petWeight->sortByDesc('created_at')->first();
      $appointment->pet->weight = $lastPetWeight?->weight . ($lastPetWeight?->unit ?? 'kg');

      $appointment->petVaccination = $appointment->pet->petVaccination->groupBy('given_at');

      $vaccinations = Vaccination::where('pet_type_id', $appointment->pet->breed->pet_type_id)->get();

      return view('app.admin.appointment.show', compact('appointment', 'vaccinations'));
   }

   public function update(Appointment $appointment, UpdateAppointmentRequest $request)
   {
      DB::beginTransaction();
      try {
         $now = now();
         if ($appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {
            $payload = [];

            foreach ($request->vaccination as $vaccination) {
               array_push(
                  $payload,
                  [
                     'pet_id' => $appointment->pet_id,
                     'vaccination_id' => Crypt::decrypt($vaccination),
                     'given_at' => $now,
                     'given_by' => $appointment->veterinarian->user->name,
                  ]
               );
            }

            $nextVaccination = $request->next_vaccination_unit == "month" ? $now->addMonth($request->next_vaccination) : $now->addYears($request->next_vaccination);

            Notification::create([
               'user_id' => $appointment->petOwner->user->id,
               'pet_id' => $appointment->pet_id,
               'title' => "Next Vaccination Schedule",
               'date_start' => $nextVaccination
            ]);

            PetVaccination::insert($payload);
         } else if ($appointment->service_type_id == self::SERVICE_TYPE_KONSULTASI) {
            MedicalRecord::create([
               'pet_id' => $appointment->pet_id,
               'appointment_id' => $appointment->id,
               'clinic_name' => $appointment->veterinarian->clinic->name,
               'veterinarian_name' => $appointment->veterinarian->user->name,
               'disease_name' => $request->disease_name,
               'medicine_name' => $request->medicine_name,
               'medicine_dosage' => $request->medicine_dosage,
               'description' => $request->note,
               'diagnosed_at' => $now
            ]);
         }

         PetWeight::create([
            'pet_id' => $appointment->pet_id,
            'weight' => $request->weight,
            'age' => isset($appointment->pet->birth_date) ? Carbon::parse($appointment->pet->birth_date)->age : 0,
            'unit' => $request->weight_unit
         ]);

         $appointment->update([
            'summary' => $request->summary,
            'finished_at' => $now
         ]);

         DB::commit();
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->withInput()->with('error-toast', "Something went wrong");
      }

      return to_route('admin.appointment.index')->with('success-toast', "Successfully Adding Appointment Summary");
   }
}
