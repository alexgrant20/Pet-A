@extends('layouts.master.layout')

@section('title', 'Hasil Tempat Praktik')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Hasil Tempat Praktik</h1>
            {{ Breadcrumbs::render('appointment-edit') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Nama Penyakit</span>
               </div>
               <input type="text" name="disease_name" class="input input-bordered w-full form-validation" />
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
               <label class="form-control w-full mb-3">
                  <div class="label">
                     <span class="label-text font-semibold">Nama Obat</span>
                  </div>
                  <input type="text" name="medicine_name" class="input input-bordered w-full form-validation" />
               </label>

               <label class="form-control w-full mb-3">
                  <div class="label">
                     <span class="label-text font-semibold">Dosis Obat</span>
                  </div>
                  <input type="text" name="medicine_dosage" class="input input-bordered w-full form-validation" />
               </label>
            </div>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Catatan</span>
               </div>
               <textarea class="textarea textarea-bordered" name="note" placeholder=""></textarea>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Hasil Janji Temu</span>
               </div>
               <textarea class="textarea textarea-bordered" name="appointment_note" placeholder=""></textarea>
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreClinicRequest', 'form') !!}

   <script>
      $(document).ready(function() {
         $('.select2').select2();

         $('#service_type_id').select2({
            minimumResultsForSearch: -1,
            placeholder: function() {
               $(this).attr('data-placeholder');
            }
         });

         $('#clinic_image').change(function() {
            previewImageWithSelector(
               this,
               '#clinic_image_preview',
               "{{ asset('assets/user.svg') }}")
         });
      });
   </script>
@endsection
