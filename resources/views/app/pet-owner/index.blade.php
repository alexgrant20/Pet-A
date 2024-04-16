@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
  <div class="pt-5 flex flex-row-reverse items-center justify-center">
    <div class="w-1/2">
      <img src="{{ asset('assets/circel-pets.svg') }}" class="unselectable" alt="">
    </div>
    <div class="w-1/2 px-10">
      <h2 class="text-3xl font-bold text-primary mb-3">My Pets</h2>
      <div class="grid grid-cols-1 gap-7 p-3 overflow-auto w-full max-h-100 xl:grid-cols-3">
        <div class="card bg-base-200 shadow-2xl flex-shrink-0">
          <div class="card-body flex-row items-center gap-5">
            <img class="w-24 h-24 rounded-full" src="{{ asset('assets/default-pet.jpg') }}" alt="Shoes" />
            <div class="flex flex-col">
              <span class="font-bold">Prancie</span>
              <span>Age: 8</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
