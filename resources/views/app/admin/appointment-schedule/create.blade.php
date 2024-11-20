@extends('layouts.master.layout')

@section('title', 'Add Veterinarian Schedule')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Add Veterinarian Schedule</h1>
            {{ Breadcrumbs::render('appointment-schedule-create') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.appointment-schedule.store') }}" method="POST">
            @csrf

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Day</span>
               </div>
               <select name="day" id="day" class="input input-bordered w-full form-validation"
                  data-placeholder="Pilih Day">
                  <option value="" hidden></option>
                  @foreach ($dayMapping as $dayNumber => $dayName)
                     <option value="{{ $dayNumber }}">{{ $dayName }}</option>
                  @endforeach
               </select>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Time</span>
               </div>
               <input type="time" name="start_time" class="input input-bordered w-full form-validation" />
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreAppointmentScheduleRequest', 'form') !!}

   <script>
      $('#day').select2({
         minimumResultsForSearch: -1,
         placeholder: function() {
            $(this).attr('data-placeholder');
         }
      });
   </script>
@endsection