@extends('layouts.master.layout')

@section('title', 'Edit Clinic')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Edit Clinic</h1>
            {{ Breadcrumbs::render('clinic-edit') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.clinic.update', $clinic->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col xl:flex-row gap-5 mb-5">
               <div class="flex flex-col gap-5 items-center justify-center mb-3 basis-1/4">
                  <div class="relative">
                     <div for="clinic_image" class="link">
                        <div
                           class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                           <i class="fa-regular fa-images"></i>
                        </div>
                     </div>
                     <img id="clinic_image_preview" class="w-36 h-36 rounded-md unselectable"
                       src="{{ asset($clinic->attachment->first()?->path) }}" alt="tempat_praktik">
                  </div>
                  <input name="clinic_image" id="clinic_image" type="file" class="hidden" accept=".png, .jpg, .jpeg"/>
               </div>

               <div class="flex-grow">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                     <div class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Name</span>
                        </div>
                        <input type="text" name="name" class="input input-bordered w-full form-control" value="{{ old('name', $clinic->name) }}"/>
                     </div>

                     <div class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Phone Number</span>
                        </div>
                        <input type="text" name="phone_number" class="input input-bordered w-full form-control" value="{{ old('phone_number', $clinic->phone_number) }}"/>
                     </div>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                     <div class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">City</span>
                        </div>
                        <select name="city_id" id="city"
                           class="select select2 select-bordered w-full form-validation max-w"
                           data-placeholder="Pilih Kota">
                           <option value="" hidden></option>
                           @foreach ($cities as $id => $name)
                              <option value="{{ $id }}" @selected(old('city', $clinic->city_id) == $id)>{{ $name }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-control w-full mb-3">
                        <div class="label">
                           <span class="label-text font-semibold">Zip Code</span>
                        </div>
                        <input type="input" name="zip_code" class="input input-bordered w-full form-control" value="{{ old('zip_code', $clinic->zip_code) }}"/>
                     </div>
                  </div>

                  <div class="form-control w-full mb-3">
                     <div class="label">
                        <span class="label-text font-semibold">Address</span>
                     </div>
                     <textarea class="textarea textarea-bordered" name="address" placeholder="">{{ old('address', $clinic->address) }}</textarea>
                  </div>
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateClinicRequest', 'form') !!}

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
