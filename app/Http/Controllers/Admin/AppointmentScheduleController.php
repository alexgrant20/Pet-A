<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentScheduleRequest;
use App\Http\Requests\Admin\UpdateAppointmentScheduleRequest;
use App\Models\AppointmentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentScheduleController extends Controller
{
   public function index()
   {
      $dayMapping =  array("2" => "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "1" => "Sunday");

      $appointmentSchedules = AppointmentSchedule::where('veterinarian_id', Auth::user()->profile_id)
         ->where('is_active', 1)
         ->orwhere('is_day_active', 0)
         ->orderBy('start_time')
         ->get()
         ->groupBy('day')
         ->sortKeys();

      $scheduleDay = AppointmentSchedule::where('veterinarian_id', Auth::user()->profile_id)
         ->where('is_active', 1)
         ->pluck('day')
         ->unique();

      return view('app.admin.appointment-schedule.index', compact('dayMapping', 'appointmentSchedules', 'scheduleDay'));
   }

   public function getList()
   {
      if (!request()->ajax()) abort(404);

      $appointmentSchedules = AppointmentSchedule::where('veterinarian_id', Auth::user()->profile_id)
         ->get()
         ->groupBy('day')
         ->sortKeys();

      $dayMapping =  array("1" => "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
      return DataTables::of($appointmentSchedules)
         ->addIndexColumn()
         ->addColumn('day', function ($data) use ($dayMapping) {
            return $dayMapping[$data[0]->day];
         })
         ->addColumn('start_time', function ($data) {
            $data = $data->sortBy('start_time');
            return view('app.admin.appointment-schedule.components.__schedule', compact('data'));
         })
         ->addColumn('action', function ($data) {
            $day = $data->first()->day;
            return view('app.admin.appointment-schedule.components.__action', compact('day'))->render();
         })
         ->make();
   }

   public function create()
   {
      $dayMapping = array("2" => "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "1" => "Sunday");
      return view('app.admin.appointment-schedule.create', compact('dayMapping'));
   }

   public function store(StoreAppointmentScheduleRequest $request)
   {
      DB::beginTransaction();
      try {
         AppointmentSchedule::create([
            'veterinarian_id' => Auth::user()->profile_id,
            'day' => $request->day,
            'start_time' => $request->start_time
         ]);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Gagal Menambahkan Jadwal Dokter Hewan');
      }

      DB::commit();
      return to_route('admin.appointment-schedule.index')->with('success-toast', 'Berhasil Menambahkan Jadwal Dokter Hewan');
   }

   public function saveSchedule($day, Request $request)
   {
      $payload = [];
      $appointmentSchedule = $request->appointment_schedule;

      $lastId = AppointmentSchedule::max('id');

      $appointmentId = array_values($appointmentSchedule['id']);

      $appointmentStartTime = array_values($appointmentSchedule['start_time']);

      for ($i = 0; $i < count($appointmentStartTime); $i++) {
         $payload[] = [
            'id' => @$appointmentId[$i] ? Crypt::decrypt($appointmentId[$i]) : ++$lastId,
            'veterinarian_id' => Auth::user()->profile_id,
            'day' => $request->day,
            'start_time' => $appointmentStartTime[$i],
            'is_active' => 1,
            'is_day_active' => 1,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'deleted_at' => null,
            'deleted_by' => null
         ];
      }

      DB::beginTransaction();
      try {
         AppointmentSchedule::upsert(
            $payload,
            ['id'],
            ['start_time', 'veterinarian_id', 'day', 'is_active', 'is_day_active', 'created_by', 'updated_by', 'deleted_at', 'deleted_by']
         );
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Something went wrong');
      }

      DB::commit();
      return to_route('admin.appointment-schedule.index')->with('success-toast', 'Successfully Saved Veterinarian Schedule');
   }

   public function update(Request $request, $day)
   {
      // $payload = [];
      // $appointmentSchedule = $request->appointment_schedule;
      // for ($i = 0; $i < count($appointmentSchedule['id']); $i++) {
      //    $payload[] = [
      //       'id' => Crypt::decrypt($appointmentSchedule['id'][$i]),
      //       'veterinarian_id' => Auth::user()->profile_id,
      //       'day' => $request->day,
      //       'start_time' => $appointmentSchedule['start_time'][$i],
      //    ];
      // }

      DB::beginTransaction();
      try {
         AppointmentSchedule::where([
            'veterinarian_id' => Auth::user()->profile_id,
            'day' => $day
         ])->get()
            ->each(function ($schedule) use ($request) {
               $schedule->update([
                  'is_active' => $request->isScheduleDayActive,
                  'is_day_active' => $request->isScheduleDayActive
               ]);
            });
      } catch (\Exception $e) {
         DB::rollBack();
         return  response()->json(['message' => 'Something went wrong'], 400);
      }

      DB::commit();
      return response()->json(['message' => 'Successfully Updated Veterinarian Schedule'], 200);
   }

   public function destroy($scheduleId)
   {
      try {
         $appointmentScheduleId = Crypt::decrypt($scheduleId);
         AppointmentSchedule::findOrFail($appointmentScheduleId)->update([
            'is_active' => 0
         ]);
      } catch (\Exception $e) {
         return  response()->json(['message' => 'Something went wrong'], 400);
      }


      return response()->json(['message' => 'Successfully Deleted Veterinarian Schedule'], 200);
   }
}
