@extends('layouts.public.layout')

@section('title', 'Login')

@section('content')
  <div class="min-h-screen bg-base-200 flex">
    <div class="w-1/2 hidden lg:block">
      <img src="{{ asset('assets/dog-and-cat.png') }}" class="h-screen w-full unselectable" alt="dog and cat image">
    </div>
    <div class="w-full p-8 flex flex-col justify-center lg:w-1/2">
      <a href="{{ route('welcome') }}" class="flex items-center gap-1">
        <img src="{{ asset('assets/logo.svg') }}" class="w-20" alt="logo">
      </a>
      <div class="flex flex-col justify-center flex-grow mx-auto w-full max-w-screen-md">
        <div>
          <h1 class="text-gray-800 text-4xl font-bold mb-3">Welcome Back!</h1>
          <h2 class="text-gray-800 text-xl font-semibold">
            Don't have account?
            <a href="{{ route('register') }}" class="link link-primary link-hover font-bold">Sign Up</a>
          </h2>
        </div>

        <div class="divider divide-neutral-700 mb-12"></div>

        <form method="POST" action="{{ route('login.attempt') }}" class="gap-5 flex flex-col w-full">
          @csrf

          <div class="form-control">
            <input type="email" name="email" placeholder="Email" class="input input-bordered form-control" />
          </div>

          <div class="form-control">
            <input type="password" name="password" placeholder="Password" class="input input-bordered form-control" />
          </div>

          <div class="form-control mt-3">
            <button class="btn btn-primary py-4 text-lg">Continue</button>
          </div>
        </form>

        <div class="divider divide-neutral-700 text-neutral-400 mt-12">OR</div>

        @include("app.auth.components.__socialite")
      </div>
    </div>
  </div>

@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\LoginRequest', 'form') !!}
@endsection
