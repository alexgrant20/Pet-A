@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section>
      <div class="flex bg-base-100 flex-wrap shadow-2xl p-9 gap-12">
         <div class="flex-grow flex-wrap flex gap-20">
            <div class="flex flex-col gap-5 items-center justify-center mb-3">
               <img id="pet_image_preview" class="w-32 h-32 rounded-full"
                  src="{{ asset($pet->attachment->first()->path) }}" alt="pet image">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 flex-grow">
               <div>
                  <p class="font-bold">Name</p>
                  <p>{{ $pet->name }}</p>
               </div>
               <div>
                  <p class="font-bold">Pet Type</p>
                  <p>{{ $pet->breed->petType->name }}</p>
               </div>
               <div>
                  <p class="font-bold">Breed</p>
                  <p>{{ $pet->breed->name }}</p>
               </div>
               <div>
                  <p class="font-bold">Age</p>
                  <p>{{ $pet->age }}</p>
               </div>
               <div>
                  <p class="font-bold">Weight</p>
                  <p>{{ $pet->weight }}</p>
               </div>

            </div>
         </div>
         <div class="flex-grow">
            <div role="tablist" class="tabs md:tabs-md tabs-xs tabs-lifted">
               <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Vaccination" checked />
               <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                  Vaccination
               </div>

               <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Medical Record" />
               <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                  Medical Record
               </div>

               <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Calendar" />
               <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
                  Calendar
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection
