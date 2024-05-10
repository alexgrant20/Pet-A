@extends('layouts.pet-owner.layout')

@section('title', 'Online Consultation')

@section('content')
   <section>
      <div class="flex justify-between mb-4">
         <h2 class="text-primary text-2xl font-bold">Medical Record</h2>
      </div>

      <div class="card">
         <div class="card-body bg-gray-200 shadow-xl">
            <div class="mb-3">
               <h2 class="font-bold mb-3">9 Maret 2020</h2>
               <div class="grid grid-flow-row grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-3">
                  <div class="card bg-base-100">
                     <div class="card-body">
                        <div class="flex items-center gap-5">
                           {{-- <div class="w-12 h-12">
                              <img class="w-full" src="{{ asset('assets/vet-paw-icon.png') }}" alt="">
                           </div> --}}
                           <div>
                              <div class="card-title">Covid-19</div>
                              <div>Test with Dr.Murca</div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>

   </section>
@endsection
