<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AppointmentTypeInterface;
use App\Interfaces\ServiceTypeInterface;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\PetVaccination;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller implements ServiceTypeInterface
{
   public function index()
   {
      return view('app.admin.appointment.index');
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
               'petAllergy',
               'attachment',
               'breed.petType',
               'medicalRecord',
               'petVaccination.vaccination'
            ]);
         },
         'petOwner' => function ($q) {
            $q->with('user', 'attachment');
         },
      ]);

      return view('app.admin.appointment.show', compact('appointment'));
   }

   public function edit(Appointment $appointment)
   {
      $appointment->load([
         'serviceType',
         'pet' => function ($q) use ($appointment) {
            $q->with([
               'petAllergy',
               'attachment',
               'breed.petType'
            ]);

            if ($appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {
               $q->with('petVaccination');
            }
         },
      ]);

      $vaccinations = Vaccination::where('pet_type_id', $appointment->pet->breed->pet_type_id)->get();

      return view('app.admin.appointment.edit', compact('appointment', 'vaccinations'));
   }

   public function update(Appointment $appointment, Request $request)
   {
      if ($appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {
         $payload = [];

         foreach ($request->vaccination as $vaccination) {
            array_push(
               $payload,
               [
                  'pet_id' => $appointment->pet_id,
                  'vaccination_id' => $vaccination,
                  'given_at' => now()->format('Y-m-d'),
                  'given_by' => $appointment->veterinarian_id,
               ]
            );
         }

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
            'description' => $request->note
         ]);
      }

      $appointment->update([
         'summary' => $request->appointment_note,
         'finished_at' => now()
      ]);

      return to_route('admin.appointment.show', $appointment->id);
   }
}
