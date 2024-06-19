@extends('layouts.pet-owner.layout')

@section('title', 'Online Consultation')

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

      <div class="grid grid-cols-1 xl:grid-cols-3 w-2/3">
         @foreach ($veterinarians as $veterinarian)
            <div class="card h-fit border border-gray-400">
               <div class="card-body px-2 py-3">
                  <div class="flex items-center gap-5">
                     <img class="max-w-28 h-full object-cover"
                        src="data:image/jpeg;base64,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"
                        alt="">
                     <div class="flex-grow flex flex-col gap-2">
                        <p class="font-semibold text-gray-800">{{ $veterinarian->user->name }}</p>
                        <p class="text-sm text-gray-700">{{ $veterinarian->petType->pluck('name')->join(', ') }}</p>
                        <div class="badge badge-primary rounded-md font-semibold">8 Tahun</div>
                        <div class="flex">
                           <p class="font-semibold text-gray-800">Rp. 50.000</p>
                           <button class="btn btn-primary btn-square px-9 py-2">Order</button>
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
