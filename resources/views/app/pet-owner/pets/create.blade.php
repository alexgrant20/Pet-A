@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section>
      <div class="flex justify-between">
         <h2 class="text-primary text-2xl font-bold">Add Pet</h2>
      </div>

      <div class="flex items-center flex-row-reverse gap-10">
         <div class="hidden w-1/2 xl:block">
            <img class="unselectable" src="{{ asset('assets/circel-pets.svg') }}" alt="pet image">
         </div>
         <form action="{{ route('pet-owner.pet.store') }}" enctype="multipart/form-data" method="POST"
            class="bg-base-100 shadow-2xl w-full xl:w-1/2 p-9">
            @csrf

            <div class="flex flex-col gap-5 items-center justify-center mb-3">
               <img id="pet_image_preview" class="w-full max-w-36 max-h-36" src="{{ asset('assets/default-pet.jpg') }}"
                  alt="">
               <input name="pet_image" id="pet_image" type="file"
                  class="file-input file-input-primary file-input-bordered file-input-sm w-full max-w-xs" />
            </div>
            <div class="grid grid-cols-2 gap-3 mb-5">
               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Pet Name</span>
                  </div>
                  <input type="text" name="name"
                     class="input input-bordered w-full form-control" />
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Pet Type</span>
                  </div>
                  {{-- PATCH FORM-CONTROL ANOMALLY --}}
                  <select id="pet_type_id" name="pet_type_id"
                     class="select select-2 select-bordered w-full form-control flex-row">
                     <option value="" hidden></option>
                     @foreach ($petTypes as $petType)
                        <option value="{{ $petType->id }}">{{ $petType->name }}</option>
                     @endforeach
                  </select>
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Breed</span>
                  </div>
                  <select id="breed_id" name="breed_id"
                     class="select select-2 select-bordered w-full form-control flex-row">
                     <option value="" hidden></option>
                  </select>
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Age</span>
                  </div>
                  <input type="text" class="input input-bordered w-full form-control"
                     name="age" />
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Weight</span>
                  </div>
                  <input type="text" class="input input-bordered w-full form-control"
                     name="weight" />
               </label>

               <label class="form-control w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Gender</span>
                  </div>
                  <select class="select select-bordered w-full form-control flex-row" name="gender">
                     <option value="" hidden></option>
                     <option value="m">Male</option>
                     <option value="f">Female</option>
                  </select>
               </label>
            </div>
            <button class="btn btn-primary btn-padding w-full">Create Paw Friend <i class="fa fa-paw"></i></button>
         </form>
      </div>
   </section>
@endsection

@section('js-footer')
   <script>
      $(function() {
         $('#pet_image').change(function() {
            previewImageWithSelector(
              this,
              '#pet_image_preview',
              "{{ asset('assets/default-pet.jpg') }}")
         });

         $('#pet_type_id').change(function() {
            $.ajax({
               method: 'post',
               url: "{{ route('master.breed') }}",
               data: {
                  pet_type_id: $(this).val()
               },
               beforeSend: function() {
                  $('#breed_id').empty().trigger("change");
               },
               success: function(data) {
                  $('#breed_id').prepend(new Option('', ''));
                  data.map((d) => $('#breed_id').append(new Option(d.text, d.id)));
               }
            })
         })
      });
   </script>

   {!! JsValidator::formRequest('App\Http\Requests\PetOwner\StorePetRequest', 'form') !!}
@endsection
