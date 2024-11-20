@extends('layouts.master.layout')

@section('title', 'Appointment Summary')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Appointment Summary</h1>
            {{ Breadcrumbs::render('appointment-summary') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-control w-full mb-3">
               <div class="label">
                  <span class="font-bold uppercase text-primary text-xs">Pet Weight</span>
               </div>
               <div>
                  <input type="text" name="weight"
                     class="input input-bordered h-9 border-2 border-primary border-2 border-primary w-full form-validation" />
               </div>
            </div>

            @if ($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_VAKSINASI)
               <div class="form-control w-full mb-3">
                  <div class="label">
                     <span class="font-bold uppercase text-primary text-xs">Vaccinations</span>
                  </div>
                  <div class="p-1">
                     @foreach ($vaccinations as $vaccination)
                        <div class="flex gap-1 items-center">
                           <input type="checkbox" id="vaccination-checkbox_{{ $loop->index }}"
                              name="vaccination[{{ $loop->index }}]" value="{{ Crypt::encrypt($vaccination->id) }}">
                           <label for="vaccination-checkbox_{{ $loop->index }}"
                              class="text-xs font-bold uppercase">{{ $vaccination->name }}</label><br>
                        </div>
                     @endforeach
                  </div>
               </div>
            @elseif($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_KONSULTASI)
               <label class="form-control w-full mb-3">
                  <div class="label">
                     <span class="font-bold uppercase text-primary text-xs">Disease</span>
                  </div>
                  <input type="text" name="disease_name"
                     class="input input-bordered h-9 border-2 border-primary w-full form-validation" />
               </label>

               <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <label class="form-control w-full mb-3">
                     <div class="label">
                        <span class="text-primary text-xs uppercase font-bold">Medicine</span>
                     </div>
                     <input type="text" name="medicine_name"
                        class="input input-bordered h-9 border-2 border-primary w-full form-validation" />
                  </label>

                  <label class="form-control w-full mb-3">
                     <div class="label">
                        <span class="text-primary text-xs uppercase font-bold">Dosage</span>
                     </div>
                     <input type="text" name="medicine_dosage"
                        class="input input-bordered h-9 border-2 border-primary w-full form-validation" />
                  </label>
               </div>

               <label class="form-control w-full mb-3">
                  <div class="label">
                     <span class="text-primary text-xs uppercase font-bold">Medicine Notes</span>
                  </div>
                  <textarea class="textarea textarea-bordered border-2 border-primary" name="note" placeholder=""></textarea>
               </label>
            @endif

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="text-primary text-xs uppercase font-bold">Summary</span>
               </div>
               <textarea class="textarea textarea-bordered border-2 border-primary" name="summary" placeholder=""></textarea>
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateAppointmentRequest', 'form') !!}

   <script>
      const serviceTypeId = "{{ $appointment->service_type_id }}";
      const SERVICE_TYPE_VAKSINASI = "{{ ServiceTypeInterface::SERVICE_TYPE_VAKSINASI }}"
      $(document).ready(function() {

         if(serviceTypeId == SERVICE_TYPE_VAKSINASI) {

         }
      });
   </script>
@endsection
