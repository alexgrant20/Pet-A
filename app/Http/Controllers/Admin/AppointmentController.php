<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AppointmentTypeInterface;
use App\Interfaces\ServiceTypeInterface;
use App\Models\Appointment;
use App\Models\MedicalRecord;
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
            $q->with(['petAllergy', 'attachment', 'breed.petType']);
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
            $q->with(['petAllergy', 'attachment', 'breed.petType']);

            if ($appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {
               $q->with('petVaccination');
            }
         },
         'petOwner' => function ($q) {
            $q->with('user', 'attachment');
         },
      ]);

      return view('app.admin.appointment.edit', compact('appointment'));
   }

   public function update(Appointment $appointment, Request $request)
   {
      if($appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {

      } else if($appointment->service_type_id == self::SERVICE_TYPE_KONSULTASI) {
         $appointment->update([
            'appointment_note' => $request->appointment_note
         ]);

         MedicalRecord::create([

         ]);
      }
   }

   public function delete()
   {
   }
}
