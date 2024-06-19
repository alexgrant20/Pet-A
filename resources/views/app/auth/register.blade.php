@extends('layouts.public.layout')

@section('title', 'Register')

@section('content')
  <div class="min-h-screen bg-base-200 flex">
    <div class="w-full lg:w-1/2 p-8 flex flex-col">
      <a href="{{ route('welcome') }}" class="flex items-center gap-1">
        <img src="{{ asset('assets/logo-square.png') }}" class="w-28" alt="logo">
      </a>
      <div class="flex flex-col justify-center flex-grow">
        <div>
          <h1 class="text-gray-800 text-4xl font-bold mb-3">Register Now!</h1>
          <h2 class="text-gray-800 text-xl font-semibold">Already have account? <a href="{{ route('login') }}"
              class="link link-primary link-hover font-bold">Sign In</a></h2>
        </div>

        <div class="divider divide-neutral-700 mb-12"></div>

        <form method="POST" action="{{ route('register.store') }}" class="gap-5 flex flex-col" autocomplete="off">
          @csrf

          <div class="grid grid-cols-2 gap-3">
            <div class="form-control">
              <input type="text" name="name" placeholder="Name" class="input input-bordered form-validation" />
            </div>

            <div class="form-control">
              <input type="email" name="email" placeholder="Email" class="input input-bordered form-validation" />
            </div>

            <div class="form-control">
              <input type="password" name="password" placeholder="Password" class="input input-bordered form-validation" />
            </div>

            <div class="form-control">
              <input type="password" name="password_confirmation" placeholder="Confirm Password"
              class="input input-bordered form-validation" />
            </div>

            <div class="form-control col-span-full">
              <input type="text" name="phone_number" placeholder="Phone Number"
              class="input input-bordered form-validation" />
            </div>
          </div>

          <div class="form-control mt-3">
            <button class="btn btn-primary py-4 text-lg">Continue</button>
          </div>
        </form>

        <div class="divider divide-neutral-700 text-neutral-700 font-semibold mt-12">OR</div>

        @include('app.auth.components.__socialite')
      </div>
    </div>
    <div class="w-1/2 hidden lg:block">
      <img src="{{ asset('assets/pet-window.png') }}" class="h-screen w-full unselectable" alt="dog and cat image">
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\RegisterRequest', 'form') !!}
@endsection
