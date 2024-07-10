@extends('layouts.master.layout')

@section('title', 'Tambah Jadwal Dokter Hewan')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Tambah Jadwal Dokter Hewan</h1>
            {{ Breadcrumbs::render('appointment-schedule-create') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.appointment-schedule.update', $day) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Hari</span>
               </div>
               <select name="day" id="day" class="input input-bordered w-full form-validation"
                  data-placeholder="Pilih Hari">
                  <option value="" hidden></option>
                  @foreach ($dayMapping as $dayNumber => $dayName)
                     <option value="{{ $dayNumber }}" @selected(old('day', $day) == $dayNumber)>{{ $dayName }}</option>
                  @endforeach
               </select>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Jadwal</span>
               </div>
               @foreach ($appointmentSchedules as $appointmentSchedule)
                  <input type="hidden" name="appointment_schedule[id][{{ $loop->index }}]"
                     value="{{ Crypt::encrypt($appointmentSchedule->id) }}">
                  <input type="time" name="appointment_schedule[start_time][{{ $loop->index }}]"
                     class="input input-bordered w-full form-validation mb-3"
                     value="{{ $appointmentSchedule->start_time }}" />
               @endforeach
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateAppointmentScheduleRequest', 'form') !!}

   <script>
      $('#day').select2({
         minimumResultsForSearch: -1,
         placeholder: function() {
            $(this).attr('data-placeholder');
         }
      });
   </script>
@endsection
