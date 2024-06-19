@extends('layouts.master.layout')

@section('title', 'Tambah Dokter Hewan')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Tambah Dokter Hewan</h1>
            {{ Breadcrumbs::render('user-management-create') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.user-management.store') }}" method="POST">
            @csrf

            <h2 class="font-bold text-xl mb-5"> Data Diri </h2>
            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Nama</span>
                  </div>
                  <input type="text" name="name" class="input input-sm input-bordered w-full form-control" />
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Lama Bekerja</span>
                  </div>
                  <input type="text" name="length_of_service"
                     class="input input-sm input-bordered w-full form-control" />
               </div>

            </label>

            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Nomor Telepon</span>
                  </div>
                  <input type="text" name="phone_number" class="input input-sm input-bordered w-full form-control" />
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Email</span>
                  </div>
                  <input type="text" name="email" class="input input-sm input-bordered w-full form-control" />
               </div>
            </label>

            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3 mb-5">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Kata sandi</span>
                  </div>
                  <input type="password" name="password" class="input input-sm input-bordered w-full form-control" />
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Konfirmasi Kata Sandi</span>
                  </div>
                  <input type="password" name="password_confirmation"
                     class="input input-sm input-bordered w-full form-control" />
               </div>
            </label>

            <br>
            <h2 class="font-bold text-xl mt-5 mb-4">Data Tempat Praktik</h2>
            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3">
               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Nama Tempat Praktik</span>
                  </div>
                  <input type="text" name="clinic_name" class="input input-sm input-bordered w-full form-control" />
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Nomor Telepon</span>
                  </div>
                  <input type="text" name="clinic_phone_number" class="input input-sm input-bordered w-full form-control" />
               </div>
            </label>

            <label class="form-control w-full mb-3 grid grid-cols-2 gap-3">
               <div class="w-full">
                  <div class="label">
                     <span class="label-text font-semibold">Kota</span>
                  </div>
                  <select name="city" id="city" class="select select-bordered select-sm w-full max-w-xs">
                     <option value="" hidden></option>
                     @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                     @endforeach
                  </select>
               </div>

               <div>
                  <div class="label">
                     <span class="label-text font-semibold">Kode Pos Tempat Praktik</span>
                  </div>
                  <input type="input" name="zip_code" class="input input-sm input-bordered w-full form-control" />
               </div>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Alamat Tempat Praktik</span>
               </div>
               <textarea class="textarea textarea-bordered" name="clinic_address" placeholder=""></textarea>
            </label>
            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Simpan</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreUserRequest', 'form') !!}
@endsection
