@extends('layouts.master.layout')

@section('title', 'Add Clinic')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Add Clinic</h1>
            {{ Breadcrumbs::render('clinic-create') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.clinic.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-5 items-center justify-center mb-3 basis-1/4">
               <div class="relative">
                  <label for="clinic_image" class="link">
                     <div
                        class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                        <i class="fa-regular fa-images"></i>
                     </div>
                  </label>
                  <img id="clinic_image_preview" class="w-36 h-36 rounded-md unselectable"
                     src="{{ asset('assets/user.svg') }}" alt="clinic image">
               </div>
               <input name="clinic_image" id="clinic_image" type="file" class="hidden" accept=".png, .jpg, .jpeg" />
            </div>

            <div class="flex flex-col xl:flex-row gap-5 mb-5">
               <div class="flex-grow">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                     <label class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Name</span>
                        </div>
                        <input type="text" name="name" class="input input-bordered w-full form-control"
                           value="{{ old('name') }}" />
                     </label>

                     <label class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Phone Number</span>
                        </div>
                        <input type="text" name="phone_number" class="input input-bordered w-full form-control"
                           value="{{ old('phone_number') }}" />
                     </label>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                     <label class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">City</span>
                        </div>
                        <select name="city_id" id="city"
                           class="select select2 select-bordered w-full form-validation max-w"
                           data-placeholder="Pilih Kota">
                           <option value="" hidden></option>
                           @foreach ($cities as $id => $name)
                              <option value="{{ $id }}" @selected(old('city') == $id)>{{ $name }}</option>
                           @endforeach
                        </select>
                     </label>

                     <label class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Zip Code</span>
                        </div>
                        <input type="input" name="zip_code" class="input input-bordered w-full form-control"
                           value="{{ old('zip_code') }}" />
                     </label>
                  </div>

                  <label class="form-control w-full mb-3">
                     <div class="label">
                        <span class="label-text font-semibold">Address</span>
                     </div>
                     <textarea class="textarea textarea-bordered" name="address" placeholder="">{{ old('address') }}</textarea>
                  </label>
               </div>
            </div>

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
