@extends('layouts.public.layout')

@section('title', 'Reset Password')

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
               <h1 class="text-gray-800 text-4xl font-bold mb-3">Reset Your Password</h1>
               <h2 class="text-gray-800 text-xl font-semibold">
                  Please enter your new password below.
               </h2>
            </div>

            <div class="divider divide-neutral-700 mb-12"></div>

            <form method="POST" action="{{ route('reset.password.post') }}" class="gap-5 flex flex-col w-full">
               @csrf
               <input type="hidden" name="token" value="{{ $token }}">

               <div class="form-control">
                  <input type="password" name="password" placeholder="Password"
                     class="input input-bordered form-validation" required />
               </div>

               <div class="form-control">
                  <input type="password" name="password_confirmation" placeholder="Confirm Password"
                     class="input input-bordered form-validation" required />
               </div>

               <div class="form-control mt-3">
                  <button class="btn btn-primary py-4 text-lg">Reset Password</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
