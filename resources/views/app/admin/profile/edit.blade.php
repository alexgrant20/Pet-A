@extends('layouts.master.layout')

@section('title', 'Veterinarian')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Add Veterinarian</h1>
            {{ Breadcrumbs::render('veterinarian-edit') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.profile.update', $veterinarian->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
               <div class="relative">
                  <label for="profile_image" class="link">
                     <div
                        class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                        <i class="fa-regular fa-images"></i>
                     </div>
                  </label>
                  <img id="profile_image_preview" class="w-36 h-36 rounded-full unselectable"
                     src="{{ asset($veterinarian->attachment->first()->path) }}" alt="veterinarian image">
               </div>
               <input name="profile_image" id="profile_image" type="file" class="hidden" accept=".png, .jpg, .jpeg" />
            </div>

            <div class="flex justify-center">
               @php
                  $rating = round($veterinarian->ratings()->avg('rating'), 1);
               @endphp

               <div class="badge bg-yellow-500 text-white py-3">
                  <i class="fa-solid fa-star"></i>
                  <span class="ms-1 font-semibold"> {{ $rating == 0 ? 'N\A' : $rating }}</span>
               </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
               <label class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Name</span>
                  </div>
                  <input type="text" name="name" value="{{ old('name', $veterinarian->user->name) }}"
                     class="input input-bordered h-9 w-full form-validation" />
               </label>

               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Email</span>
                  </div>
                  <input type="text" name="email" value="{{ old('email', $veterinarian->user->email) }}"
                     class="input input-bordered h-9 w-full form-validation" />
               </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-5">
               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Phone Number</span>
                  </div>
                  <input type="text" name="phone_number"
                     value="{{ old('phone_number', $veterinarian->user->phone_number) }}"
                     class="input input-bordered h-9 w-full form-validation" />
               </div>

               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Date of Birth</span>
                  </div>
                  <input type="text" name="birth_date" value="{{ old('birth_date', $veterinarian->user->birth_date) }}"
                     class="input h-9 input-bordered w-full date-picker" />
               </div>

               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Gender</span>
                  </div>
                  <select id="gender"
                     class="px-2 border border-gray-300 h-9 rounded-lg bg-transparent w-full form-control flex-row"
                     name="gender">
                     <option value="" hidden></option>
                     <option value="m" @selected(old('gender', $veterinarian->user->gender) == 'm')>Male</option>
                     <option value="f" @selected(old('gender', $veterinarian->user->gender) == 'f')>Female</option>
                  </select>
               </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-5">
               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Clinic</span>
                  </div>
                  <select id="clinic"
                     class="border px-2 border-gray-300 h-9 rounded-lg bg-transparent w-full form-control flex-row"
                     name="clinic_id">
                     <option value="" hidden></option>
                     @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}" @selected(old('clinic_id', $veterinarian->clinic_id) == $clinic->id)>{{ $clinic->name }}
                        </option>
                     @endforeach
                  </select>
               </div>

               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Length of Service</span>
                  </div>
                  <input type="text" name="length_of_service"
                     value="{{ old('length_of_service', $veterinarian->length_of_service) }}"
                     class="input h-9 input-bordered w-full form-validation" />
               </div>

               <div class="form-control w-full">
                  <div class="label">
                     <span class="text-primary text-sm font-bold">Veterinarian Speciality</span>
                  </div>
                  <select id="speciality"
                     class="select-2 border border-gray-300 rounded-lg bg-transparent w-full form-control flex-row"
                     name="veterinarian_pet_type[]" multiple data-placeholder="">
                     <option hidden></option>
                     @foreach ($petTypes as $petType)
                        <option value="{{ $petType->id }}">{{ $petType->name }}
                        </option>
                     @endforeach
                  </select>
                  </select>
               </div>
            </div>

            <div class="form-control w-full mb-5">
               <div class="label">
                  <span class="text-primary text-sm font-bold">Address</span>
               </div>
               <textarea name="address" class="textarea textarea-bordered w-full form-validation">{{ old('address', $veterinarian->user->address) }}</textarea>
            </div>

            <div class="flex justify-end">
               <button type="submit" class="btn btn-primary btn-padding">Save</button>
            </div>

         </form>
      </div>
   </div>
@endsection

@section('css-extra')
   <style>
      .select2-container--default .select2-selection--single,
      .select2-container--default .select2-selection--multiple {
         height: 2.25rem;
      }
   </style>
@endsection

@section('js-footer')
   <script>
      const el = document.querySelector('[name="birth_date"]');
      new AirDatepicker(el, {
         ...airDatePickerDefaultConfiguration,
         maxDate: new Date(),
      });

      $(document).ready(function() {
         const prevVeterinarianPetTypeId = {{ $veterinarian->petType->pluck('id') }}.map(String);

         $('[name="gender"]').val("{{ $veterinarian->user->gender }}");
         $('#profile_image').change(function() {
            previewImageWithSelector(
               this,
               '#profile_image_preview',
               "{{ asset('assets/user.svg') }}")
         });
         $('[name="veterinarian_pet_type[]"]').val(prevVeterinarianPetTypeId).trigger('change');
      })
   </script>

   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateVeterinarianRequest', 'form') !!}
@endsection
