@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
   <section class="flex justify-stretch mb-9">
      <div class="w-3/12 card">
         <div class="card-body bg-base-300 rounded shadow-2xl relative">
            <div class="overflow-y-auto">
               <ul class="max-h-48 space-y-4 no-scrollbar pet_select_list">
                  @foreach ($pets as $pet)
                     <li class="flex justify-center cursor-pointer pet_select_item" pet-id="{{ $pet->id }}">
                        <img class="w-16 h-16 rounded-full" src="{{ asset($pet->thumbnail_image) }}" alt="pet-image">
                     </li>
                  @endforeach
               </ul>
            </div>
            <div class="flex items-center justify-center pt-3">
               <a class="flex items-center justify-center text-white bg-primary rounded-full w-12 h-12 p-0 absolute bottom-5"
                  href="{{ route('pet-owner.pet.create') }}">
                  <i class="fa fa-solid fa-plus"></i>
               </a>
            </div>
         </div>
      </div>
      <div class="w-9/12 card">
         <div class="card-body bg-base-200 rounded shadow-2xl pet_detail_container">
            <div class="hidden container_pet_not_found">
               <div class="flex flex-col items-center justify-center w-full">
                  <img class="text-primary" src="{{ asset('assets/crying-dog-icon.svg') }}" alt="">
                  <span class="mb-2 text-lg">Tidak terdapat data hewan</span>
                  <a href="{{ route('pet-owner.pet.create') }}" class="btn btn-primary btn-padding"><i
                        class="fa fa-solid fa-plus"></i> Tambahkan Hewan</a>
               </div>
            </div>

            <div class="container_pet_detail w-full flex flex-row items-center">
               <div class="w-3/12">
                  <div class="w-full">
                     <img class="rounded-full w-36 h-36 pet_image" src="#" alt="">
                  </div>
               </div>
               <div class="w-7/12">
                  <h1 class="text-3xl font-bold pet_name"></h1>

                  <div class="mt-8 flex flex-col justify-center gap-3 text-lg">
                     <div>
                        <i class="fa-solid fa-cake-candles me-2"></i>
                        <span class="pet_birth_date"></span>
                     </div>
                     <div>
                        <i class="fa-solid fa-paw me-2"></i>
                        <span class="pet_breed"></span>
                     </div>
                     <div>
                        <i class="fa-solid fa-weight-hanging me-2"></i>
                        <span class="pet_weight"></span>
                     </div>
                     <div>
                        <i class="fa-solid fa-venus-mars me-2"></i>
                        <span class="pet_gender"></span>
                     </div>
                  </div>
               </div>
               <div class="w-2/12 flex justify-end self-start">
                  <a href="#" class="btn btn-primary btn-padding pet_edit_button">
                     <i class="fa-solid fa-pencil me-2"></i> Edit
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="mb-9">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
         <div class="card col-span-2">
            <div class="card-body shadow-2xl">
               <h1>Last Appointment</h1>
               <table>
                  <thead>
                     <th>test</th>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <div id="calendar" class="h-100"></div>
      </div>
   </section>
@endsection

@section('js-footer')
   <script>
      const pets = @json($pets);

      $('table').DataTable({
         bLengthChange: false,
         autoWidth: false,
      });

      $(document).ready(function() {
         initPetDetailView(pets);

         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
         });
         calendar.render();
      });

      $('.pet_select_item').click(function() {
         const petId = $(this).attr('pet-id');

         updatePetViewData(pets, petId);
      });

      function initPetDetailView(pets) {
         if (pets.length === 0) {
            $('.container_pet_detail').hide();
            $('.container_pet_not_found').show();
            return;
         }

         updatePetViewData(pets, pets[0].id);
      }

      function updatePetViewData(pets, selectedPetId) {
         const pet = pets.find(pet => pet.id == selectedPetId);
         const petEditTemplateRoute = "{{ route('pet-owner.pet.edit', ':ID:') }}";

         $('.pet_select_list li img').removeClass('border-4 border-primary');
         $(`[pet-id=${selectedPetId}] img`).addClass('border-4 border-primary');

         const petTextPayloadWithClassName = {
            'pet_name': pet.name,
            'pet_weight': pet.weight,
            'pet_breed': pet.breed.name,
            'pet_birth_date': pet.birth_date,
            'pet_gender': pet.gender
         };

         $.each(petTextPayloadWithClassName, function(className, value) {
            $('.' + className).text(value);
         });

         $('.pet_image').attr('src', pet.thumbnail_image);
         $('.pet_edit_button').attr('href', petEditTemplateRoute.replace(':ID:', pet.id))
      }
   </script>

@endsection
