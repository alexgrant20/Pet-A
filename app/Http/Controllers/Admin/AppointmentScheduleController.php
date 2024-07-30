<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentScheduleRequest;
use App\Http\Requests\Admin\UpdateAppointmentScheduleRequest;
use App\Models\AppointmentSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentScheduleController extends Controller
{
   public function index()
   {
      return view('app.admin.appointment-schedule.index');
   }

   public function getList()
   {
      if (!request()->ajax()) abort(404);

      $appointmentSchedules = AppointmentSchedule::where('veterinarian_id', Auth::user()->profile_id)
         ->get()
         ->groupBy('day')
         ->sortKeys();

      $dayMapping = array("1" => "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
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
      $dayMapping = array("2" => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "1" => "Minggu");
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

   public function edit($day)
   {
      $appointmentSchedules = AppointmentSchedule::where([
         ['veterinarian_id', Auth::user()->profile_id],
         ['day', $day]
      ])
         ->get();
      $dayMapping = array("2" => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "1" => "Minggu");

      return view('app.admin.appointment-schedule.edit', compact('day', 'dayMapping', 'appointmentSchedules'));
   }

   public function update(UpdateAppointmentScheduleRequest $request)
   {
      $payload = [];
      $appointmentSchedule = $request->appointment_schedule;
      for ($i = 0; $i < count($appointmentSchedule['id']); $i++) {
         $payload[] = [
            'id' => Crypt::decrypt($appointmentSchedule['id'][$i]),
            'veterinarian_id' => Auth::user()->profile_id,
            'day' => $request->day,
            'start_time' => $appointmentSchedule['start_time'][$i],
         ];
      }

      DB::beginTransaction();
      try {
         AppointmentSchedule::upsert(
            $payload,
            ['id'],
            ['start_time']
         );
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Gagal Mengubah Jadwal Dokter Hewan');
      }

      DB::commit();
      return to_route('admin.appointment-schedule.index')->with('success-toast', 'Berhasil Mengubah Jadwal Dokter Hewan');
   }

   public function destroy($scheduleId)
   {
      try {
         $appointmentScheduleId = Crypt::decrypt($scheduleId);
      } catch (\Exception $e) {
         return back()->with('error-toast', 'Gagal Menghapus Jadwal Dokter Hewan');
      }

      AppointmentSchedule::where('id', $appointmentScheduleId)->delete();

      return to_route('admin.appointment-schedule.edit', $appointmentScheduleId)->with('success-toast', 'Berhasil Menghapus Jadwal Dokter Hewan');
   }
}
