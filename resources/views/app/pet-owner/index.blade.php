@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
   <section class="flex flex-row-reverse items-center justify-center">
      <div class="w-1/2 hidden lg:block ms-20">
         <img src="{{ asset('assets/circel-pets.svg') }}" class="unselectable" alt="">
      </div>
      <div class="w-full lg:w-1/2 card">
         <div class="card-body bg-base-200 shadow-2xl rounded-3xl">
            <h2 class="text-3xl font-bold text-primary mb-3">My Pets</h2>
            <div
               class="grid {{ !$pets->isEmpty() ? 'auto-cols-[7rem]' : 'grid-cols-1'}} grid-flow-col gap-2 overflow-auto w-full bg-base-200 rounded-2xl mb-3 no-scrollbar">
               @forelse ($pets as $pet)
                  <div class="flex flex-col items-center">
                     <figure class="w-full max-w-32">
                        <img src="{{ asset( $pet->attachment->first() ? ('storage/' . $pet->attachment->first()->path) :'assets/default-pet.jpg') }}" alt="Shoes" />
                     </figure>
                     <span class="text-center max-w-full truncate overflow-hidden font-semibold">{{ $pet->name }}</span>
                  </div>
               @empty
                  <div class=" h-24 flex items-center justify-center bg-slate-200">
                     <a class="link text-gray-500" href="{{ route('pet-owner.pet.create') }}">Click Here to Create Pets</a>
                  </div>
               @endforelse
            </div>
            <a href="{{ route('pet-owner.pet.index') }}" class="btn btn-primary btn-padding">Show All Pets <i class="fa fa-paw"></i> </a>
         </div>
      </div>
   </section>

   <section>
      <h2 class="text-3xl font-bold text-primary mb-3">Menus</h2>

      <div class="grid grid-cols-4">
         <a class="flex flex-col items-center gap-2 cursor-pointer text-gray-900">
            <figure class="w-14 h-14">
               <img class="rounded-full" src="{{ asset('assets/default-pet.jpg') }}" alt="Shoes" />
            </figure>
            <span class="font-semibold">
              Online Consultation
            </span>
          </a>
      </div>

   </section>
@endsection

@section('js-footer')

   <script></script>

@endsection
