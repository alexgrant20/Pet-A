<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClinicRequest;
use App\Http\Requests\Admin\UpdateClinicRequest;
use App\Interfaces\RoleInterface;
use App\Interfaces\ServiceTypeInterface;
use App\Models\Appointment;
use App\Models\City;
use App\Models\Clinic;
use App\Models\PetOwner;
use App\Models\Veterinarian;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HomeController extends Controller implements RoleInterface, ServiceTypeInterface
{
   public function index()
   {
      $appointmentQuery = Appointment::when(Auth::user()->hasRole(self::ROLE_VETERINARIAN), function ($q) {
         $q->where('veterinarian_id', Auth::user()->profile_id);
      });

      $totalFinishedAppointmentThisMonth = (clone $appointmentQuery)
         ->whereNotNull('finished_at')
         ->whereMonth('appointment_date', now()->month)
         ->get()
         ->count();

      $finishedAppointmentLastMonth = (clone $appointmentQuery)
         ->whereNotNull('finished_at')
         ->whereMonth('appointment_date', now()->month - 1)
         ->get()
         ->count();

      $totalFinishedAppointmentDifference = ($finishedAppointmentLastMonth == 0 || $totalFinishedAppointmentThisMonth == 0) ? 0 : (($totalFinishedAppointmentThisMonth - $finishedAppointmentLastMonth) / $totalFinishedAppointmentThisMonth) * 100;

      $totalTodayAppointment = (clone $appointmentQuery)->where('appointment_date', today())->count();
      $activeAppointments = (clone $appointmentQuery)->with([
         'appointmentSchedule',
         'serviceType',
         'pet.breed.petType',
         'petOwner' => function ($q) {
            $q->with('user');
         }
      ])->whereNull('finished_at')->get();

      $differenceTotalAppointmentIcon = '';
      if ($totalFinishedAppointmentDifference < 0) {
         $differenceTotalAppointmentClass = 'error';
         $differenceTotalAppointmentIcon = 'fa-caret-down';
      } else {
         $differenceTotalAppointmentClass = 'success';
         $differenceTotalAppointmentIcon = 'fa-caret-up';
      }

      $petOwnerCount = PetOwner::count();
      $clinicCount = Clinic::count();
      $veterinarianCount = Veterinarian::count();

      $totalConsultationAppointment = $this->getTotalAppointment((clone $appointmentQuery)->where('service_type_id', self::SERVICE_TYPE_KONSULTASI)->get());
      $totalVaccinationAppointment = $this->getTotalAppointment((clone $appointmentQuery)->where('service_type_id', self::SERVICE_TYPE_VAKSINASI)->get());

      $returnedPayload = Auth::user()->hasRole(self::ROLE_VETERINARIAN) ?
         [
            'activeAppointments',
            'totalTodayAppointment',
            'totalFinishedAppointmentThisMonth',
            'totalFinishedAppointmentDifference',
            'differenceTotalAppointmentClass',
            'differenceTotalAppointmentIcon',
            'totalVaccinationAppointment',
            'totalConsultationAppointment'
         ] :
         [
            'petOwnerCount',
            'clinicCount',
            'veterinarianCount',
            'activeAppointments',
            'totalConsultationAppointment',
            'totalVaccinationAppointment'
         ];

      return view('app.admin.index', compact(...$returnedPayload));
   }

   private function getTotalAppointment($appointment)
   {
      $listYearMonth = [];
      for ($i = 11; $i >= 0; $i--) {
         $yearMonth = Carbon::now()->startOfMonth()->subMonth($i)->format('Y-m');
         array_push($listYearMonth, $yearMonth);
      }

      $appointmentRange = $appointment->filter(function ($value) {
         $date = Carbon::parse($value->appointment_date);
         $dateRange = now()->startOfMonth()->subYear(1); // 1 Tahun terakhir
         if ($date >= $dateRange)
            return $value;
      });

      $appointmentGroupedBy = $appointmentRange->map(function ($item) {
         $dateYearMonth = Carbon::parse($item->appointment_date)->format('Y-m');
         $item->appointment_year_month = $dateYearMonth;

         return $item;
      })
         ->groupBy('appointment_year_month');

      $appointmentGroupByYearMonth = collect($listYearMonth)->mapWithKeys(function ($value) use ($appointmentGroupedBy) {
         $totalAppointment = 0;
         if (!is_null(@$appointmentGroupedBy[$value])) {
            $totalAppointment = $appointmentGroupedBy[$value]->count();
         }
         return [
            $value => [
               'month' => $value,
               'totalAppointment' => $totalAppointment,
            ]
         ];
      });

      return $appointmentGroupByYearMonth;
   }
}
