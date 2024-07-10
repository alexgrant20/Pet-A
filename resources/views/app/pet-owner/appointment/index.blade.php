@extends('layouts.pet-owner.layout')

@section('title', 'Appointment')

@section('content')
   <div class="flex gap-2 min-h-[inherit]">
      <div class="w-1/3 border-e flex flex-col items-center min-h-[inherit]">
         <h1 class="text-2xl text-gray-800 font-bold mb-3">Chat Dokter di Pet-A</h1>
         <span class="text-gray-600 mb-5">Layanan telemedisin yang siap siaga untuk bantu kamu hidup lebih sehat</span>
         <div class="owl-carousel owl-theme">
            <div class="flex flex-col gap-3 items-center justify-center">
               <div class="w-36 h-36">
                  <img class="w-full" src="{{ asset('assets/dog-and-cat.png') }}" alt="">
               </div>
               <span class="font-semibold">Memiliki banyak dokter yang terverifikasi</span>
            </div>
            <div class="flex flex-col gap-3 items-center justify-center">
               <div class="w-36 h-36">
                  <img class="w-full" src="{{ asset('assets/circel-pets.svg') }}" alt="">
               </div>
               <span class="font-semibold">Memiliki banyak dokter yang terverifikasi</span>
            </div>
         </div>

      </div>

      <div class="grid gap-5 grid-cols-1 xl:grid-cols-2 w-2/3">
         @foreach ($veterinarians as $veterinarian)
            <div class="card h-fit border border-gray-400">
               <div class="card-body px-2 py-3">
                  <div class="flex items-center gap-5">
                     <img class="w-28 h-28 object-cover rounded"
                        src="{{ asset($veterinarian->attachment->first()?->path) }}"
                        alt="">
                     <div class="flex-grow flex flex-col gap-2">
                        <p class="font-semibold text-gray-800">{{ $veterinarian->user->name }}</p>
                        <p class="text-sm text-gray-700">{{ $veterinarian->petType->pluck('name')->join(', ') }}</p>
                        <div class="badge badge-primary rounded-md font-semibold">8 Tahun</div>
                        <div class="flex items-center justify-center mt-3">
                           <p class="font-semibold text-gray-800">Rp. 50.000</p>
                           <a href="{{ route('pet-owner.appointment.create') }}" class="btn btn-primary btn-square px-9 py-2">Order</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      $('.owl-carousel').owlCarousel({
         items: 1,
         loop: true,
         autoplay: true,
      })


      $(document).ready(function() {
         // $('body').show();
      })
   </script>
@endsection
