@extends('layouts.pet-owner.layout')

@section('title', 'Appointment')

@section('content')
   <div class="flex flex-col gap-5 min-h-[inherit] py-10 px-6">
      <label class="input input-bordered flex items-center gap-2">
         <input type="text" class="grow" placeholder="Search" />
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
            <path fill-rule="evenodd"
               d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
               clip-rule="evenodd" />
         </svg>
      </label>

      <div class="grid grid-cols-3 gap-4 pet_type_select">
         @foreach ($petTypes as $petType)
            <input class="hidden pet_type_id" type="radio" name="pet_type_id" value="{{ $petType->id }}"
               id="pet_type_{{ $petType->id }}">
            <label for="pet_type_{{ $petType->id }}">
               <div
                  class="bg-primary text-white bg-opacity-75 border-orange-800 flex flex-col gap-4 items-center justify-center cursor-pointer rounded-xl item py-3">
                  <i class="{{ $petType->icon->name }} fa-2x"></i>
                  <span class="text-xl font-bold">{{ ucwords($petType->name) }}</span>
               </div>
            </label>
         @endforeach
      </div>

      <div class="grid gap-5 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 w-full">
         @foreach ($veterinarians as $veterinarian)
            <div class="card h-fit bg-orange-50 shadow-2xl">
               <div class="card-body px-2 py-3">
                  <div class="flex items-center gap-5">
                     <img class="w-14 h-14 object-cover rounded-full"
                        src="{{ asset($veterinarian->attachment->first()->path) }}"
                        alt="">

                     <div class="flex flex-col flex-1">
                        <div class="flex-grow flex gap-2">
                           <p class="font-bold text-gray-800">{{ $veterinarian->user->name }}</p>

                           <div class="badge bg-slate-500  text-white">
                              <i class="fa-solid fa-star"></i>
                              <span class="ms-1 font-semibold"> N/A</span>
                           </div>
                        </div>
                        <div class="flex flex-row gap-1">
                           @foreach ($veterinarian->petType->pluck('name') as $petType)
                              <div class="badge badge-primary rounded-full font-semibold">{{ $petType }}</div>
                           @endforeach
                        </div>
                     </div>
                  </div>

                  <div class="bg-gray-200/50 rounded-lg">
                     <div class="grid grid-cols-2 p-2">
                        <div class="flex">
                           <div class="flex flex-col flex-1 items-center">
                              <span class="text-neutral font-semibold">Pengalaman</span>
                              <span class="text-black/60 font-bold">{{ $veterinarian->length_of_service }} Tahun</span>
                           </div>
                        </div>
                        <div class="flex flex-col flex-1 items-center">
                           <span class="text-neutral font-semibold">Klinik</span>
                           <span class="text-black/60 font-bold">{{ $veterinarian->clinic->name }}</span>
                        </div>
                     </div>
                     <a class="bg-primary text-white flex gap-2 justify-center items-center p-2 w-full hover:brightness-90"
                        href="{{ route('pet-owner.appointment.create', $veterinarian->id) }}">
                        <span class="font-bold">Book Appointment</span>
                        <i class="fa-regular fa-chevron-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      $(document).ready(function() {
         // $('body').show();
      })
   </script>
@endsection
