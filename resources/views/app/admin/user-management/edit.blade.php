@extends('layouts.master.layout')

@section('title', 'Edit User Data')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Edit User Data</h1>
            {{ Breadcrumbs::render('user-management-edit') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.user-management.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h2 class="font-bold text-xl mb-5"> User Profile </h2>
            <label class="form-control w-full mb-3">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Name</span>
                  </div>
                  <input type="text" name="name" class="input input-sm input-bordered w-full form-control"
                     value="{{ $user->name }}" />
               </div>
            </label>

            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Phone Number</span>
                  </div>
                  <input type="text" name="phone_number" class="input input-sm input-bordered w-full form-control"
                     value="{{ $user->phone_number }}" />
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Email</span>
                  </div>
                  <input type="text" name="email" class="input input-sm input-bordered w-full form-control"
                     value="{{ $user->email }}" />
               </div>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Status</span>
               </div>
               <select class="select select-bordered select-sm w-full max-w-xs" name="is_active" id="is_active"
                  data-placeholder="Pilih Status">
                  <option value="1" @selected('1' == old('is_active', $user->is_active))>Active</option>
                  <option value="0" @selected('0' == old('is_active', $user->is_active))>Inactive</option>
               </select>
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateUserRequest', 'form') !!}
@endsection
