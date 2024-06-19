@extends('layouts.pet-owner.layout')

@section('title', 'Profile')

@section('content')
   @php
      $profilePicture = $user->profile->attachment->first();
   @endphp
   <section>
      <div class="flex bg-base-100 shadow-2xl p-9 gap-12 w-full flex-col xl:flex-row">
         <form action="{{ route('pet-owner.profile.update', $user->profile->id) }}" method="POST"
            enctype="multipart/form-data" class="flex flex-col gap-20 xl:w-1/2">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
               <img id="profile_image_preview" class="w-full max-w-36 max-h-36 rounded-full unselectable"
                  src="{{ asset($profilePicture ? $profilePicture->path : 'assets/user.svg') }}"
                  alt="profile image">
               <input name="profile_image" id="profile_image" type="file"
                  class="file-input file-input-primary file-input-bordered file- w-full max-w-xs" />
            </div>
            <div class="grid grid-cols-2 gap-3">
               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Name</span>
                  </div>
                  <input type="text" name="name" value="{{ $user->profile->name }}"
                     class="input input-bordered w-full form-validation" />
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Address</span>
                  </div>
                  <input type="text" name="address" value="{{ $user->profile->address }}"
                     class="input input-bordered w-full form-validation" />
               </label>
               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Phone Number</span>
                  </div>
                  <input type="text" name="phone_number" value="{{ $user->profile->phone_number }}"
                     class="input input-bordered w-full form-validation" />
               </label>
               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Province</span>
                  </div>
                  <select name="province_id" id="province_id" class="select select-2 select-bordered">
                     <option value=""></option>
                     @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                     @endforeach
                  </select>
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">City</span>
                  </div>
                  <select name="city_id" id="city_id" class="select select-2 select-bordered">
                  </select>
               </label>

               <button class="btn btn-padding col-span-1 btn-primary mt-6 xl:col-span-2" type="submit">Submit</button>
            </div>
         </form>
         <div class="w-1/2">

         </div>
      </div>
   </section>
@endsection

@section('js-footer')

   <script>
      $('#profile_image').change(function() {
         previewImageWithSelector(
            this,
            '#profile_image_preview',
            "{{ asset('assets/default-pet.jpg') }}")
      });

      $('#province_id').change(function() {
         $.ajax({
            method: 'post',
            url: "{{ route('master.city') }}",
            data: {
               province_id: $(this).val()
            },
            beforeSend: function() {
               $('#city_id').empty().trigger("change");
            },
            success: function(data) {
               $('#city_id').prepend(new Option('', ''));
               data.map((d) => $('#city_id').append(new Option(d.text, d.id)));
               const selectedCityId = "{{ $user->profile->city_id }}";
               $('#city_id').val(selectedCityId).trigger('change');
            }
         })
      })
      $(function() {
         const selectedProvinceId = "{{ $user->profile->province_id }}";

         if (selectedProvinceId) {
            $('#province_id').val(selectedProvinceId).trigger('change');
         }
      });
   </script>
@endsection
