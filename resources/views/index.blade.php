@extends('layouts.public.layout')

@section('title', 'Home')

@section('content')
  <div class="py-20 hero min-h-screen bg-base-100">
    <div class="hero-content flex-col lg:flex-row-reverse gap-20 w-100">
      <img data-aos="fade-left" data-aos-duration="1000" src="{{ asset('assets/hero-image.png') }}" class="max-w-md w-full" />
      <div data-aos="fade-right" data-aos-duration="1000">
        <h1 class="text-7xl font-bold">The <span class="text-primary">best</span> place for your pet personal health care</h1>
        <p class="pt-6 text-xl text-gray-500">
          Introducing the ultimate pet companion app that puts your furry friend's health first! Keep your pet's
          well-being in check with just a tap, ensuring they lead a happy, healthy life by your side.
        </p>
        <div class="pt-4 flex gap-10">
          <label class="flex items-center gap-2 flex-row-reverse">
            <span class="font-semibold text-gray-600">Vaccination</span>
            <input type="checkbox" checked="checked"
              class="checkbox rounded-full checkbox-sm checkbox-accent border-base-100 cursor-default"
              onClick='return false;' />
          </label>
          <label class="flex items-center gap-2 flex-row-reverse">
            <span class="font-semibold text-gray-600">Medical Record</span>
            <input type="checkbox" checked="checked"
              class="checkbox rounded-full checkbox-sm checkbox-accent border-base-100 cursor-default"
              onClick='return false;' />
          </label>
          <label class="flex items-center gap-2 flex-row-reverse">
            <span class="font-semibold text-gray-600">Anthelmintic</span>
            <input type="checkbox" checked="checked"
              class="checkbox rounded-full checkbox-sm checkbox-accent border-base-100 cursor-default"
              onClick='return false;' />
          </label>
        </div>
        <div class="pt-4 flex items-center gap-2">
          <a href="#" class="btn btn-primary rounded-full text-base-100 px-10 text-base">Get Started</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 pt-12">
          <div class="card shadow-2xl">
            <div class="card-body items-center text-center">
              <i class="fa-solid fa-paw fa-3x"></i>
              <h2 class="card-title">Pet</h2>
              <p class="text-3xl font-bold">30</p>
              <p class="text-sm text-gray-500">used by owner</p>
            </div>
          </div>
          <div class="card shadow-2xl">
            <div class="card-body items-center text-center">
              <i class="fa-regular fa-hospital fa-3x"></i>
              <h2 class="card-title">Veterinary</h2>
              <p class="text-3xl font-bold">100</p>
              <p class="text-sm text-gray-500">verified vet in pet-a</p>
            </div>
          </div>
          <div class="card shadow-2xl">
            <div class="card-body items-center text-center">
              <i class="fa-solid fa-user-doctor fa-3x"></i>
              <h2 class="card-title">Vet</h2>
              <p class="text-3xl font-bold">50k+</p>
              <p class="text-sm text-gray-500">verified vet in pet-a</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    AOS.init();
  </script>
@endsection
