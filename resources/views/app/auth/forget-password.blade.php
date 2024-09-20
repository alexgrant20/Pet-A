@extends('layouts.public.layout')

@section('title', 'Forgot Password')

@section('content')
   <div class="min-h-screen bg-base-200 flex">
      <div class="w-1/2 hidden lg:block">
         <img src="{{ asset('assets/dog-and-cat.png') }}" class="h-screen w-full unselectable" alt="dog and cat image">
      </div>
      <div class="w-full p-8 flex flex-col justify-center lg:w-1/2">
         <a href="{{ route('welcome') }}" class="flex items-center gap-1">
            <img src="{{ asset('assets/logo-square.png') }}" class="w-28" alt="logo">
         </a>
         <div class="flex flex-col justify-center flex-grow mx-auto w-full max-w-screen-md">
            <div>
               <h1 class="text-gray-800 text-4xl font-bold mb-3">Forgot Your Password?</h1>
               <h2 class="text-gray-800 text-xl font-semibold">
                  Enter your email address to receive a password reset link.
               </h2>
            </div>

            <div class="divider divide-neutral-700 mb-12"></div>

            @if (Session::has('message'))
               <div class="alert alert-success mb-4" role="alert">
                  {{ Session::get('message') }}
               </div>
            @endif

            <form method="POST" action="{{ route('forget.password.post') }}" class="gap-5 flex flex-col w-full">
               @csrf

               <div class="form-control">
                  <input type="email" name="email" placeholder="E-Mail Address"
                     class="input input-bordered form-validation" required autofocus />
               </div>

               <div class="form-control mt-3">
                  <button class="btn btn-primary py-4 text-lg">Send Password Reset Link</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
