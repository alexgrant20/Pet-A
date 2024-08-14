@extends('layouts.public.layout')

@section('title', 'Home')

@section('content')
  <div>
    @include('layouts.public.navbar')

    <section class="pt-20 hero min-h-screen bg-base-200" id="home">
      <div class="hero-content h-full flex-col lg:flex-row-reverse gap-20 justify-end relative">
        <img src="{{ asset('assets/hero-page-image.png') }}"
          class="w-screen h-screen absolute right-0 bottom-0" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-1/2">
          <h1 class="text-7xl text-gray-900 font-bold">Pet <span class="text-primary">personal</span> health care
          </h1>
          <p class="pt-9 text-xl text-gray-500">
            Keep your pet's well-being in check with just a tap, ensuring they lead a happy, healthy life by your side.
          </p>
          <div class="pt-6 flex items-center gap-2">
            <a href="{{ route('login') }}" class="btn btn-primary rounded-full text-lg btn-padding">Get Started</a>
          </div>
        </div>
      </div>
    </section>

    <section class="pt-20 hero min-h-screen bg-base-200" id="digitilize-data">
      <div class="hero-content h-full flex-row-reverse gap-20 justify-end relative">
        <img src="{{ asset('assets/pet-ktp.png') }}"
          class="w-screen h-screen absolute right-0 bottom-0" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-1/2">
          <h3 class="text-5xl text-gray-900 font-bold">Track your pet <span class="text-primary">medical record</span>
            easiliy</h3>
          <p class="pt-9 text-xl text-gray-500">
            No more concerns about losing track about your medical record!
          </p>
          <div class="pt-6 flex items-center gap-2">
            <a href="{{ route('login') }}" class="btn btn-primary rounded-full text-lg btn-padding">Get Started</a>
          </div>
        </div>
      </div>
    </section>

    <section class="pt-20 hero min-h-screen bg-base-200" id="notification">
      <div class="hero-content h-full flex-col lg:flex-row-reverse gap-20 justify-end relative">
        <img src="{{ asset('assets/high-five-pet.png') }}"
          class="w-screen h-screen absolute right-0 bottom-0" />
        <div data-aos="fade-right" data-aos-duration="1000" class="w-1/2">
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
            <a href="{{ route('login') }}" class="btn btn-primary rounded-full text-lg btn-padding">Try Out Now</a>
          </div>
        </div>
      </div>
    </section>

    <div class="bg-primary">

       @include('layouts.public.footer')
    </div>

    <script>
      AOS.init({
        once: true,
      });
    </script>
  </div>
@endsection
