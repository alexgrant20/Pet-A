@extends('layouts.master.layout')

@section('title', 'Appointment')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Appointment</h1>
            {{ Breadcrumbs::render('appointment') }}
         </div>
      </div>
   </div>

   <div class="flex gap-2 my-5 py-3">
      <div class="shadow-xl rounded-3xl">
         <a href="{{ route('admin.appointment.index', ['isActive' => 1]) }}"
            class="rounded-3xl border border-2 border-primary bg-base-100 text-primary hover:bg-primary hover:text-white @if ($isActive == 1 || is_null($isActive)) bg-primary text-white @endif p-3">Upcoming
            Appointment</a>
      </div>
      <div class="shadow-xl rounded-3xl">
         <a href="{{ route('admin.appointment.index', ['isActive' => 0]) }}"
            class="rounded-3xl border border-2 border-primary bg-base-100 text-primary hover:bg-primary hover:text-white @if ($isActive == 0) bg-primary text-white @endif p-3">Finished
            Appointment</a>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <div class="grid grid-rows-4 gap-5">
            @forelse ($appointments as $appointment)
               <div class="card">
                  <a href="{{ route('admin.appointment.show', $appointment->id) }}"
                     class="card-body bg-white/65 shadow-xl rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-300">
                     <div class="py-4 flex flex-col font-bold justify-center h-full">
                        <div class="border-r-2 px-8">
                           <span class="text-primary text-sm block">{{ $appointment->appointment_date->format('l') }}</span>
                           <span>{{ $appointment->appointment_date->format('M d, Y') }}</span>
                           <div class="flex items-center gap-2 text-sm mt-2">
                              <i class="fa-solid fa-clock text-gray-400"></i>
                              <span class="text-gray-700">{{ $appointment->appointmentSchedule->start_time->format('H:i') }}</span>
                           </div>
                        </div>
                     </div>
                     <div class="py-4 flex flex-col gap-2">
                        <div class="text-gray-900 font-semibold">
                           {{ $appointment->pet->name }}
                        </div>
                        <div class="flex items-center gap-2">
                           <i class="fa-solid fa-clock text-gray-400"></i>
                           <span class="text-gray-900">{{ $appointment->appointmentSchedule->start_time }}</span>
                        </div>
                        <div class="badge badge-primary">
                           {{ $appointment->serviceType->name }}
                        </div>
                     </div>
                     <div class="ms-auto pe-4 text-transparent group-hover:text-primary duration-500">
                        <i class="fa-solid fa-arrow-right text-lg"></i>
                     </div>
                  </a>
               </div>
            @empty
               <div class="card">
                  <div class="card-body items-center justify-center p-5">
                     <span class="font-bold text-gray-700">
                        There is No @if ($isActive == 0)
                           Finished
                        @endif Appointment Yet
                     </span>
                  </div>
               </div>
            @endforelse
         </div>
      </div>
   </div>
@endsection
