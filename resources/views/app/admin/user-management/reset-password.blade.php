@extends('layouts.master.layout')

@section('title', 'Change Password')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Change Password</h1>
            {{ Breadcrumbs::render('user-management-change-password') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.user-management.reset-password.change', $user->id) }}" method="POST">
            @csrf

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Password</span>
               </div>
               <input type="password" name="password" class="input input-sm input-bordered w-full form-control" />
            </label>


            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Password Confirmation</span>
               </div>
               <input type="password" name="password_confirmation"
                  class="input input-sm input-bordered w-full form-control" />
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\ResetPasswordRequest', 'form') !!}
@endsection
