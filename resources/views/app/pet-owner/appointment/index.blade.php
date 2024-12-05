@extends('layouts.pet-owner.layout')

@section('title', 'Appointment')

@section('content')
   <div class="flex flex-col gap-8 min-h-[inherit] py-10 px-6">
      <div class="w-full bg-white/30 p-6 rounded shadow-xl">
         <h2 class="text-2xl font-bold mb-5 text-gray-800">Your Appointment</h2>
         <table class="w-full table-auto text-left" id="appointment_history">
            <thead>
               <tr>
                  <th class="font-bold">
                     <p>Pet</p>
                  </th>
                  <th class="font-bold">
                     <p>Doctor</p>
                  </th>
                  <th class="font-bold w-36">
                     <p>Date</p>
                  </th>
                  <th class="font-bold w-28">
                     <p>Status</p>
                  </th>
                  <th class="font-bold w-12">
                     <p>Rating</p>
                  </th>
                  <th class="font-bold w-1">
                     <p class=""></p>
                  </th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
      </div>

      <div class="shadow bg-white/30 p-4 flex flex-col gap-5">
         <form onsubmit="return searchQuery(event)">
            <label class="input input-bordered flex items-center gap-2">
               <input type="text" id="search" class="grow" placeholder="Search (Press Enter)"
                  value="{{ $name }}" onchange="searchQuery()" />
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70">
                  <path fill-rule="evenodd"
                     d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                     clip-rule="evenodd" />
               </svg>
            </label>
         </form>

         <div class="grid grid-cols-3 gap-4 pet_type_select">
            @php
               $processedParams = collect(request()->query())
                   ->map(function ($value, $key) {
                       return ['key' => $key, 'value' => $value];
                   })
                   ->toArray();

               $selectedPetTypeId = @$processedParams['pet_type_id']['value'];
            @endphp

            @foreach ($petTypes as $petType)
               <button onclick="appendQuery('pet_type_id', {{ $petType->id }})"
                  class="{{ $selectedPetTypeId == $petType->id ? 'bg-accent' : 'bg-primary' }} text-white bg-opacity-75 border-orange-800 flex flex-col gap-4 items-center justify-center cursor-pointer rounded-xl item py-3">
                  <i class="{{ $petType->icon->name }} fa-2x"></i>
                  <span class="text-xl font-bold">{{ ucwords($petType->name) }}</span>
               </button>
            @endforeach
         </div>

         <div class="grid gap-5 grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 w-full">
            @foreach ($veterinarians as $veterinarian)
               <div class="card h-fit bg-black/10 shadow-xl overflow-hidden">
                  <div class="card-body pt-3 p-0">
                     <div class="flex items-center gap-5 p-3">
                        <img class="w-14 h-14 object-cover rounded-full"
                           src="{{ asset($veterinarian->attachment->first()->path) }}" alt="">

                        <div class="flex flex-col flex-1">
                           <div class="flex-grow flex gap-2">
                              <p class="font-bold text-gray-800">{{ $veterinarian->user->name }}</p>

                              @php
                                 $rating = round($veterinarian->ratings()->avg('rating'), 1);
                              @endphp

                              <div class="badge bg-slate-500  text-white">
                                 <i class="fa-solid fa-star"></i>
                                 <span class="ms-1 font-semibold">{{ $rating == 0 ? 'N\A' : $rating }}</span>
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
                                 <span class="text-neutral font-semibold">Experience</span>
                                 <span class="text-black/60 font-bold">{{ $veterinarian->length_of_service }} Tahun</span>
                              </div>
                           </div>
                           <div class="flex flex-col flex-1 items-center">
                              <span class="text-neutral font-semibold">Clinic</span>
                              <span
                                 class="text-black/60 font-bold text-center truncate">{{ $veterinarian->clinic->name }}</span>
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
         {{ $veterinarians->links() }}
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      function appendQuery(key, value) {
         let url = new URL(window.location.href);
         url.searchParams.set(key, value);
         window.location.href = url.toString();
      }

      function searchQuery(e) {
         const val = $('#search').val();
         appendQuery('name', val);

         return false;
      }

      $(document).ready(function() {
         const appointment = @json($appointment);
         console.log(appointment)

         $('#appointment_history').DataTable({
            autoWidth: false,
            order: [],
            data: appointment,
            columns: [{
                  data: 'pet.name',
                  name: 'pet.name',
               },
               {
                  data: 'veterinarian.user.name',
                  name: 'veterinarian.user.name'
               },
               {
                  data: 'appointment_date_formatted',
                  name: 'appointment_date_formatted',
                  type: 'string',
               },
               {
                  data: 'status',
                  name: 'status',
                  render: function(data, index, row) {
                     return row.is_cancelled ?
                        `<div class="w-fit badge uppercase font-bold border border-red-500 bg-red-500/20 text-red-900 text-xs">
                              <span>Cancelled</span>
                           </div>` :
                        (row.finished_at ?
                           `<div class="w-fit badge uppercase border border-green-500 bg-green-500/20 text-green-900 text-xs">
                           <span>Done</span>
                           </div>` :
                           `<div class="w-fit badge uppercase font-bold border border-secondary bg-secondary/20 text-blue-900 text-xs">
                              <span>On-Going</span>
                        </div>`);

                  }
               },
               {
                  data: 'rating.rating',
                  name: 'rating.rating.',
                  type: 'string',
                  render: function(data, index, row) {
                     return `
                        <div>
                           <i class='fa-solid fa-star text-warning'></i>
                           <span class="font-bold text-sm">${data ?? 'N/A'}</span>
                        </div>
                     `
                  }
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function(data, index, row) {
                     let route = "{{ route('pet-owner.appointment.show', ':id') }}".replace(':id', row
                        .id);

                     return `
                        <a href="${route}" class="Link">
                           <i class="fa-light fa-eye"></i>
                        </a>
                     `
                  }
               }
            ]
         })
      })
   </script>
@endsection
