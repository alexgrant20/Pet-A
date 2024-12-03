<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RoleInterface;
use App\Interfaces\ServiceTypeInterface;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Pet;
use App\Models\PetOwner;
use App\Models\Veterinarian;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller implements RoleInterface, ServiceTypeInterface
{
   public function index()
   {
      $appointmentQuery = Appointment::when(Auth::user()->hasRole(self::ROLE_VETERINARIAN), function ($q) {
         $q->where('veterinarian_id', Auth::user()->profile_id);
      });

      $totalFinishedAllAppointment = (clone $appointmentQuery)->whereNotNull('finished_at')->count();

      $upcomingAppointmentThisMonth = (clone $appointmentQuery)
         ->whereMonth('appointment_date', now()->month)
         ->get()
         ->count();

      $upcomingAppointmentLastMonth = (clone $appointmentQuery)
         ->whereMonth('appointment_date', now()->month - 1)
         ->get()
         ->count();

      $totalUpcomingAppointmentDifference = ($upcomingAppointmentLastMonth == 0 || $upcomingAppointmentThisMonth == 0) ? 0 : ((float)(($upcomingAppointmentThisMonth / $upcomingAppointmentLastMonth) - 1)) * 100;

      // dd($upcomingAppointmentLastMonth, $upcomingAppointmentThisMonth, $totalUpcomingAppointmentDifference);
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
      if ($totalUpcomingAppointmentDifference < 0) {
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

      $totalPets = $this->getTotalPet();
      $vaccinationAppointment = $this->getVaccinationAppointment();
      $consultationAppointment = $this->getConsultationAppointment();
      $returnedPayload = Auth::user()->hasRole(self::ROLE_VETERINARIAN) ?
         [
            'activeAppointments',
            'totalTodayAppointment',
            'totalFinishedAllAppointment',
            // 'totalUpcomingAppointmentDifference',
            // 'differenceTotalAppointmentClass',
            // 'differenceTotalAppointmentIcon',
            'totalConsultationAppointment',
            'totalVaccinationAppointment',
         ] :
         [
            'petOwnerCount',
            'clinicCount',
            'veterinarianCount',
            'activeAppointments',
            'totalConsultationAppointment',
            'totalVaccinationAppointment',
            'totalPets',
            'vaccinationAppointment',
            'consultationAppointment',
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

   private function getTotalPet()
   {
      $petGroupByPetType = [];
      Pet::with('breed.petType')
         ->get()
         ->each(function ($item) use (&$petGroupByPetType) {
            $petGroupByPetType[$item->breed->petType->name][] = $item->id;
         });

      $totalPetGroupByPetType = collect($petGroupByPetType)->mapWithKeys(function ($value, $key) {
         return [$key => count($value)];
      })->toArray();

      return [
         'petType' => array_keys($totalPetGroupByPetType),
         'totalPet' => array_values($totalPetGroupByPetType),
         'totalAllPet' => Pet::count(),
      ];
   }

   private function getVaccinationAppointment()
   {
      $vaccinationGroupByPetType = [];
      Appointment::with('pet.breed.petType')->where('service_type_id', self::SERVICE_TYPE_VAKSINASI)
         ->get()
         ->each(function ($item) use (&$vaccinationGroupByPetType) {
            $vaccinationGroupByPetType[$item->pet->breed->petType->name][] = $item->id;
         });

      $totalVaccinationGroupByPetType = collect($vaccinationGroupByPetType)->mapWithKeys(function ($value, $key) {
         return [$key => count($value)];
      })->toArray();

      return [
         'petType' => array_keys($totalVaccinationGroupByPetType),
         'totalVaccination' => array_values($totalVaccinationGroupByPetType),
      ];
   }

   private function getConsultationAppointment()
   {
      $consultationGroupByPetType = [];
      Appointment::with('pet.breed.petType')->where('service_type_id', self::SERVICE_TYPE_VAKSINASI)
         ->get()
         ->each(function ($item) use (&$consultationGroupByPetType) {
            $consultationGroupByPetType[$item->pet->breed->petType->name][] = $item->id;
         });

      $totalConsultationGroupByPetType = collect($consultationGroupByPetType)->mapWithKeys(function ($value, $key) {
         return [$key => count($value)];
      })->toArray();

      return [
         'petType' => array_keys($totalConsultationGroupByPetType),
         'totalConsultation' => array_values($totalConsultationGroupByPetType),
      ];
   }
}
