@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
  <section class="p-4">
    <div class="flex justify-between mb-4">
      <h2 class="text-primary text-2xl font-bold">Pet Family</h2>
      <a href="{{ route('pet-owner.pet.create') }}" class="btn btn-primary btn-padding">Add Pet <i class="fa fa-solid fa-plus"></i></a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 max-h-128 gap-4 overflow-auto w-full bg-base-200 rounded-2xl mb-3 p-3 shadow-xl no-scrollbar">
      @forelse ($pets as $pet)
        <div class="card card-compact bg-white shadow-xl">
          <figure class="w-full h-32">
            <img src="{{ asset( $pet->attachment->first() ? $pet->attachment->first()->path :'assets/default-pet.jpg') }}" alt="pet image" />
          </figure>
          <div class="card-body">
            <h2 class="card-title">{{ $pet->name }}</h2>
          </div>
          <div class="flex">
            <div class="flex-grow flex items-center justify-center">
              <a href="{{ route('pet-owner.pet.show', $pet->id) }}" class="btn no-animation btn-primary btn-padding w-full rounded-sm" href="#">Pet Details</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-12 flex items-center justify-center h-24 text-gray-500">
          No Pets Found
        </div>
      @endforelse
    </div>
  </section>

@endsection
