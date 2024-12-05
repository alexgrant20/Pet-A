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

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <div role="tablist" class="tabs-boxed w-fit bg-gray-200 mb-3">
            <a href="{{ route('admin.appointment.index', ['isActive' => 1]) }}" role="tab"
               class="tab @if ($isActive == 1) tab-active @endif">Upcoming</a>
            <a href="{{ route('admin.appointment.index', ['isActive' => 0]) }}" role="tab"
               class="tab @if ($isActive == 0) tab-active @endif">History</a>
         </div>
         <div class="grid grid-rows-4 gap-5">
            @forelse ($appointments as $appointment)
               <div class="card">
                  <a href="{{ route('admin.appointment.show', $appointment->id) }}"
                     class="card-body bg-white/65 shadow-xl rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-300">
                     <div class="py-4 flex flex-col font-bold justify-center h-full">
                        <div class="border-r-2 px-8">
                           <span
                              class="text-primary text-sm block">{{ $appointment->appointment_date->format('l') }}</span>
                           <span>{{ $appointment->appointment_date->format('M d, Y') }}</span>
                           <div class="flex items-center gap-2 text-sm mt-2">
                              <i class="fa-solid fa-clock text-gray-400"></i>
                              <span
                                 class="text-gray-700">{{ $appointment->appointmentSchedule->start_time->format('H:i') }}</span>
                           </div>
                        </div>
                     </div>
                     <div class="py-4 flex flex-col gap-2 flex-1">
                        <div class="flex items-center gap-2">
                           <img class="mt-4 w-8 h-8 object-cover rounded-full"
                              src="{{ asset($appointment->petOwner->attachment->first()?->path ?? 'assets/user.svg') }}"
                              alt="pet owner image">
                           <span class="text-gray-900">{{ $appointment->petOwner->user->name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                           <i class="{{ $appointment->pet->breed->petType->icon->name }}"></i>
                           <span class="text-gray-900">{{ $appointment->pet->name }}</span>
                        </div>
                        <div class="badge badge-primary">
                           {{ $appointment->serviceType->name }}
                        </div>
                     </div>
                     @if ($appointment->is_cancelled)
                        <div class="justify-end">
                           <div class="border-2 py-1 px-3 border-red-500 rounded-3xl bg-base-100">
                              <span class="text-red-500">cancelled</span>
                           </div>
                        </div>
                     @endif
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
