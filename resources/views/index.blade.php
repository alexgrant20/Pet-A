@extends('layouts.public.layout')

@section('title', 'Home')

@section('content')
  <div>
    <section class="pt-20 hero min-h-screen bg-base-100" id="home">
      <div class="hero-content flex-col lg:flex-row-reverse gap-20">
        <img data-aos="fade-left" data-aos-duration="1000" src="{{ asset('assets/hero-image.avif') }}" class="max-w-md" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-7/12">
          <h1 class="text-7xl text-gray-900 font-bold">Pet <span class="text-primary">personal</span> health care
          </h1>
          <p class="pt-9 text-xl text-gray-500">
            Keep your pet's well-being in check with just a tap, ensuring they lead a happy, healthy life by your side.
          </p>
          <div class="pt-6 flex items-center gap-2">
            <a href="#" class="btn btn-primary rounded-full text-lg">Get Started</a>
          </div>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 pt-4">
            <div class="card shadow-xl rounded-badge transition-shadow bg-base-200 cursor-pointer hover:shadow-2xl">
              <div class="card-body items-center text-center">
                <i class="fa-solid fa-paw fa-2x p-4 bg-primary text-primary-content rounded-full"></i>
                <p class="text-3xl font-bold text-gray-900">30k+</p>
                <h2 class="text-xl font-semibold text-gray-900">Pet</h2>
                <p class="text-sm text-gray-500">spread arround indonesia</p>
              </div>
            </div>
            <div class="card shadow-xl rounded-badge transition-shadow bg-base-200 cursor-pointer hover:shadow-2xl">
              <div class="card-body items-center text-center">
                <i class="fa-solid fa-hospital text-3xl p-4 bg-primary text-primary-content rounded-full"></i>
                <p class="text-3xl font-bold text-gray-900">100+</p>
                <h2 class="text-xl font-semibold text-gray-900">Clinic</h2>
                <p class="text-sm text-gray-500">spread arround indonesia</p>
              </div>
            </div>
            <div class="card shadow-xl rounded-badge transition-shadow bg-base-200 cursor-pointer hover:shadow-2xl">
              <div class="card-body items-center text-center">
                <i class="fa-solid fa-user-doctor fa-2x p-4 bg-primary text-primary-content rounded-full"></i>
                <p class="text-3xl font-bold text-gray-900">500+</p>
                <h2 class="text-xl font-semibold text-gray-900">Veterinary</h2>
                <p class="text-sm text-gray-500">spread arround indonesia</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-20 hero min-h-screen bg-base-200 flex flex-col" id="digitilize-data">
      <h2 class="text-6xl text-gray-900 font-bold"><span class="text-accent">Digitilize</span> Your Pet Data</h2>
      <div class="hero-content flex-col lg:flex-row-reverse gap-20">
        <img data-aos="fade-left" data-aos-duration="1000" src="{{ asset('assets/medical-book.svg') }}" class="max-w-sm"
          style="transform: rotate3d(1, 1, 1, 15deg);" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-7/12">
          <h3 class="text-5xl text-gray-900 font-bold">Good Bye to <span class="text-primary">Vaccination Books</span>
          </h3>
          <p class="pt-9 text-xl text-gray-500">
            No more concerns about losing your vaccination book!
          </p>
        </div>
      </div>
      <div class="hero-content flex-col lg:flex-row gap-20">
        <img data-aos="fade-left" data-aos-duration="1000" src="{{ asset('assets/medical-record.webp') }}"
          class="max-w-sm" style="transform: rotate3d(1, 1, 1, 15deg);" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-7/12">
          <h3 class="text-5xl text-gray-900 font-bold">Track your pet <span class="text-primary">medical record</span>
            easiliy</h3>
          <p class="pt-9 text-xl text-gray-500">
            No more concerns about losing track about your medical record!
          </p>
        </div>
      </div>
    </section>

    <section class="pb-20 hero min-h-screen bg-base-200" id="notification">
      <div class="hero-content flex-col lg:flex-row gap-20">
        <img data-aos="fade-left" data-aos-duration="1000" src="{{ asset('assets/calendar-2.svg') }}" class="max-w-md"
          style="transform: rotate3d(1, 1, 1, 15deg);" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-7/12">
          <h2 class="text-6xl text-gray-900 font-bold">
            Never Miss a <span class="text-secondary">Health</span> Beat
          </h2>
          <p class="pt-9 text-xl text-gray-500">
            Receive friendly reminders for upcoming appointments and keep all your medical records safe and accessible.
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
          <div class="pt-6 flex items-center gap-2">
            <a href="#" class="btn btn-primary rounded-full text-lg">Try Out Now</a>
          </div>
        </div>
      </div>
    </section>

    <script>
      AOS.init({
        once: true,
      });
    </script>
  </div>
@endsection
