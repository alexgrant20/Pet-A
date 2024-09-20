@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section class="px-5 py-10">

      <div class="flex flex-col items-center justify-center">
         <img class="w-24 h-24 rounded-full mb-3" src="{{ asset($veterinarian->attachment->first()->path) }}" alt="">
         <h1 class="text-3xl font-bold text-gray-800">{{ $veterinarian->user->name }}</h1>

         <div class="flex flex-row gap-1 mb-5">
            @foreach ($veterinarian->petType->pluck('name') as $petType)
               <div class="badge badge-primary rounded-full font-semibold">{{ $petType }}</div>
            @endforeach
         </div>


         <div class="w-full lg:w-1/2 text-center text-gray-500">
            {{ $veterinarian->clinic->name }}
         </div>
      </div>

      <div class="card mb-5">
         <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl flex flex-row justify-between gap-3">
            <div class="flex items-center gap-3">
               <div class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
                  <i class="fa-solid fa-briefcase-blank text-gray-600"></i>
               </div>
               <div>
                  <div class="text-gray-400">Total Experience</div>
                  <div class="text-gray-800 font-bold">{{ $veterinarian->length_of_service }} Years</div>
               </div>
            </div>
            <div class="flex items-center gap-3">
               <div class="w-8 h-8 flex items-center justify-center bg-gray-300  rounded-full">
                  <i class="fa-solid fa-star text-gray-600"></i>
               </div>
               <div>
                  @php
                     $rating = round($veterinarian->ratings()->avg('rating'), 1);
                  @endphp

                  <div class="text-gray-400">Rating</div>
                  <div class="text-gray-800 font-bold">{{ $rating == 0 ? 'N\A' : $rating }} ({{ $veterinarian->ratings()->count() }})</div>
               </div>
            </div>
         </div>
      </div>

      <form method="POST" action="{{ route('pet-owner.appointment.store') }}">
         @csrf
         <input type="hidden" name="veterinarian_id" value="{{ $veterinarian->id }}">

         <div class="card mb-5">
            <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl grid lg:grid-cols-2 gap-3">
               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Appointment Date</span>
                  </div>

                  <input type="text" name="appointment_date" class="input input-bordered w-full appointment_date"
                     readonly />
               </label>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Hour</span>
                  </div>

                  <select class="select-2" data-placeholder="" id="appointment_schedule_id"
                     name="appointment_schedule_id"></select>
               </div>
            </div>
         </div>

         <div class="card mb-5">
            <div class="card-body bg-base-100 shadow-xl p-4">
               <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
                  <label class="form-control w-full">
                     <div class="label">
                        <span class="label-text font-semibold">Pet</span>
                     </div>
                     <div>
                        <select id="pet_id" name="pet_id"
                           class="select select-2 select-bordered w-full form-control flex-row" data-placeholder="">
                           <option value="" hidden></option>
                           @foreach ($pets as $pet)
                              <option value="{{ $pet->id }}" @selected($pet->id == @session('session_pet')->id)>{{ $pet->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </label>

                  <label class="form-control w-full">
                     <div class="label">
                        <span class="label-text font-semibold">Service</span>
                     </div>
                     <div>
                        <select id="service_type_id" name="service_type_id"
                           class="select select-2 select-bordered w-full form-control flex-row" data-placeholder="">
                           <option value="" hidden></option>
                           @foreach ($serviceTypes as $serviceTypeId => $serviceTypeName)
                              <option value="{{ $serviceTypeId }}">{{ $serviceTypeName }}</option>
                           @endforeach
                        </select>
                     </div>
                  </label>

                  <label class="form-control w-full lg:col-span-2">
                     <div class="label">
                        <span class="label-text font-semibold">Note</span>
                     </div>
                     <textarea name="appointment_note" class="textarea textarea-bordered w-full form-validation"></textarea>
                  </label>
               </div>
            </div>
         </div>

         <div class="flex justify-end">
            <button type="submit" class="btn btn-primary btn-padding accept" id="submit">Submit</button>
         </div>
      </form>
   </section>
@endsection

@section('js-footer')
   <script>
      const veterinarian = @json($veterinarian);
      const veterinarianActiveDate = @json($veterinarianActiveDate);

      const el = document.querySelector('.appointment_date');
      new AirDatepicker(el, {
         ...airDatePickerDefaultConfiguration,
         onSelect({
            formattedDate,
            date,
            inst
         }) {
            const event = new Event("change", {
               bubbles: true
            });
            el.dispatchEvent(event);
         },
         minDate: new Date(),
         onRenderCell: ({
            date
         }) => {
            if (!(veterinarianActiveDate.includes(date.getDay().toString()))) {
               return {
                  disabled: true
               }
            }
         }
      });

      $('[name="appointment_date"]').on('change', function() {

         const dateString = $(this).val();
         const route = "{{ route('pet-owner.appointment.get-appointment-schedule', [':id', ':date']) }}"
            .replace(':id', veterinarian.id)
            .replace(':date', dateString);

         $('#appointment_schedule_id').html('').select2({
            data: [{
               id: '',
               text: ''
            }]
         });

         $.get(route, function(data) {
            const map = data.map((itm) => {
               return {
                  id: itm.id,
                  text: itm.start_time,
               }
            });

            $('#appointment_schedule_id').select2({
               data: map,
            });
         });
      });
   </script>

   {!! JsValidator::formRequest('App\Http\Requests\PetOwner\StoreAppointmentRequest', 'form') !!}
@endsection
