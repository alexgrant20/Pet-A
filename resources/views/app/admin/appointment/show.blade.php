@extends('layouts.master.layout')

@section('title', 'Detail Janji Temu')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Detail Janji Temu</h1>
            {{ Breadcrumbs::render('appointment-show') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <div class="grid grid-cols-1 md:grid-cols-2 gap-3 flex align-middle">
            <div class="form-control w-full grid grid-cols-2 md:grid-cols-4 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Tujuan Janji Temu</span>
               </div>
               <div class="col-span-3">
                  <span>: {{ $appointment->serviceType->name }}</span>
               </div>
            </div>

            <div class="form-control w-full grid grid-cols-2 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Nama Pemilik Hewan Peliharaan</span>
               </div>
               <div class="">
                  <span>: {{ $appointment->petOwner->user->name }}</span>
               </div>
            </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="form-control w-full grid grid-cols-2 md:grid-cols-4 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Tanggal Janji Temu</span>
               </div>
               <div class="col-span-2">
                  <span>: {{ $appointment->getAppointmentDate() }}</span>
               </div>
            </div>

            <div class="form-control w-full grid grid-cols-2 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Nomor Telepon</span>
               </div>
               <div class=" align-center">
                  <span>: {{ $appointment->petOwner->user->phone_number }}</span>
               </div>
            </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="form-control w-full grid grid-cols-2 md:grid-cols-4 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Sesi Janji Temu</span>
               </div>
               <div class="col-span-2">
                  <span>: {{ $appointment->getAppointmentTime() }}</span>
               </div>
            </div>

            <div class="form-control w-full grid grid-cols-2 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Jenis Kelamin</span>
               </div>
               <div class="align-center">
                  <span>:
                     @if ($appointment->petOwner->user->gender == 'm')
                        Laki-laki
                     @else
                        Perempuan
                     @endif
                  </span>
               </div>
            </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
            <div class="form-control w-full grid grid-cols-2 md:grid-cols-4 gap-2">
               <div class="label">
                  <span class="label-text font-semibold">Keterangan</span>
               </div>
               <div class="col-span-3">
                  <span>: {{ $appointment->appointment_note }}</span>
               </div>
            </div>
         </div>

         <h2 class="font-bold text-xl mb-5">Data Hewan Peliharaan</h2>
         <div class="flex flex-col xl:flex-row gap-5 mb-5">
            <div class="flex flex-col gap-5 items-center justify-center mb-1 flex-grow basis-1/4">
               <div class="relative">
                  <img id="pet_image_preview" class="w-36 h-36 rounded-md unselectable"
                     src="{{ asset($appointment->pet->attachment->first()?->path) }}" alt="pet image">
               </div>
            </div>

            <div class="flex-grow">
               <div class="form-control w-full mb-1 grid grid-cols-2 md:grid-cols-4 gap-2">
                  <div class="label">
                     <span class="label-text font-semibold">Nama</span>
                  </div>
                  <div class="col-span-3">
                     <span>: {{ $appointment->pet->name }}</span>
                  </div>
               </div>

               <div class="form-control w-full mb-1 grid grid-cols-2 md:grid-cols-4 gap-2">
                  <div class="label">
                     <span class="label-text font-semibold">Usia</span>
                  </div>
                  <div class="col-span-3">
                     <span>: {{ $appointment->pet->getAge() }}</span>
                  </div>
               </div>

               <div class="form-control w-full mb-1 grid grid-cols-2 md:grid-cols-4 gap-2">
                  <div class="label">
                     <span class="label-text font-semibold">Jenis Kelamin</span>
                  </div>
                  <div class="col-span-3">
                     <span>:
                        @if ($appointment->pet->gender == 'm')
                           Jantan
                        @else
                           Betina
                        @endif
                     </span>
                  </div>
               </div>

               <div class="form-control w-full mb-1 grid grid-cols-2 md:grid-cols-4 gap-2">
                  <div class="label">
                     <span class="label-text font-semibold">Ras</span>
                  </div>
                  <div class="col-span-3">
                     <span>: {{ $appointment->pet->breed->name }}</span>
                  </div>
               </div>

               <div class="form-control w-full mb-1 grid grid-cols-2 md:grid-cols-4 gap-2">
                  <div class="label">
                     <span class="label-text font-semibold">Alergi</span>
                  </div>
                  <div class="col-span-3">
                     <span>:
                        @if ($appointment->pet->petAllergy->isEmpty())
                           Tidak ada alergi
                        @else
                           @foreach ($appointment->pet->petAllergy as $petAllergy)
                              @if ($loop->index == 0)
                                 {{ $petAllergy->name }}
                              @else
                                 , {{ $petAllergy->name }}
                              @endif
                           @endforeach
                        @endif
                     </span>
                  </div>
               </div>
            </div>
         </div>

         <div class="text-end">
            <a href="{{ route('admin.appointment.edit', $appointment->id) }}" class="btn btn-primary btn-padding text-sm">Tulis Hasil Janji Temu</a>
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      $('.btn-submit').click(function() {
         $('#form').submit();
      });
   </script>
@endsection
