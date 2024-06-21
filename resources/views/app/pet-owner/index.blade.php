@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
   <section class="flex flex-row-reverse items-center justify-center mb-9">
      <div class="w-1/2 hidden lg:block ms-20">
         <img src="{{ asset('assets/circel-pets.svg') }}" class="unselectable" alt="">
      </div>
      <div class="w-full lg:w-1/2 card">
         <div class="card-body bg-base-200 shadow-2xl rounded-3xl">
            <h2 class="text-3xl font-bold text-primary mb-3">My Pets</h2>
            <div
               class="grid {{ !$pets->isEmpty() ? 'auto-cols-[7rem]' : 'grid-cols-1' }} grid-flow-col gap-2 overflow-auto w-full bg-base-200 rounded-2xl mb-3 no-scrollbar">
               @forelse ($pets as $pet)
                  <a href="{{ route('pet-owner.pet.show', $pet->id) }}" class="flex flex-col items-center">
                     <figure class="w-24 h-24 rounded-full">
                        <img src="{{ asset($pet->attachment->first()->path) }}" alt="pet image" />
                     </figure>
                     <span class="text-center max-w-full truncate overflow-hidden font-semibold">{{ $pet->name }}</span>
                  </a>
               @empty
                  <div class=" h-24 flex items-center justify-center bg-slate-200">
                     <a class="link text-gray-500" href="{{ route('pet-owner.pet.create') }}">Click Here to Create Pets</a>
                  </div>
               @endforelse
            </div>
            <a href="{{ route('pet-owner.pet.index') }}" class="btn btn-primary btn-padding">Show All Pets <i
                  class="fa fa-paw"></i> </a>
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
      $('table').DataTable({
         bLengthChange: false,
         autoWidth: false,
      });

      document.addEventListener('DOMContentLoaded', function() {
         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
         });
         calendar.render();
      });
   </script>

@endsection
