@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section class="px-5 py-10">

      <div class="flex flex-col items-center justify-center">
         <img class="w-24 h-24 rounded-full mb-3"
            src="https://static.vecteezy.com/system/resources/thumbnails/028/287/384/small/a-mature-indian-male-doctor-on-a-white-background-ai-generated-photo.jpg"
            alt="">
         <h1 class="text-3xl font-bold text-gray-800">Dr. Heart Stone</h1>

         <div class="flex flex-row gap-1 mb-5">
            <div class="badge badge-primary rounded-full font-semibold">Anjing</div>
         </div>

         <div class="w-full lg:w-1/2 text-center text-gray-500">
            Jl. Raya Kb. Jeruk No.27, RT.1/RW.9, Kemanggisan, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota
            Jakarta 11530
         </div>
      </div>

      <div class="card mb-5">
         <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl flex flex-row justify-between gap-3">
            <div class="flex items-center gap-3">
               <div class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
                  <i class="fa-solid fa-briefcase-blank text-gray-600"></i>
               </div>
               <div>
                  <div class="text-gray-400">Total Experience</div>
                  <div class="text-gray-800 font-bold">5 Years</div>
               </div>
            </div>
            <div class="flex items-center gap-3">
               <div class="w-8 h-8 flex items-center justify-center bg-gray-300  rounded-full">
                  <i class="fa-solid fa-star text-gray-600"></i>
               </div>
               <div>
                  <div class="text-gray-400">Rating</div>
                  <div class="text-gray-800 font-bold">N\A (0)</div>
               </div>
            </div>
         </div>
      </div>

      <div class="card mb-5">
         <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl flex flex-row items-center gap-3">
            <div class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full">
               <i class="fa-solid fa-rupiah-sign text-gray-600"></i>
            </div>
            <div class="">
               <div class="text-gray-800 font-bold">Rp. 250.000</div>
               <div class="text-gray-400 font-bold">Service Fee</div>
            </div>
         </div>
      </div>

      <div class="card">
         <div class="card-body bg-base-100 shadow-xl">
            <form action="#" class="pet_basic_detail_form" enctype="multipart/form-data">
               <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-5">
                  <label class="form-control w-full">
                     <div class="label">
                        <span class="label-text font-semibold">Hewan Peliharaan</span>
                     </div>
                     <div>
                        <select id="pet_id" name="pet_id"
                           class="select select-2 select-bordered w-full form-control flex-row" data-placeholder="">
                           <option value="" hidden></option>
                           @foreach ($pets as $pet)
                              <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </label>

                  <label class="form-control w-full">
                     <div class="label">
                        <span class="label-text font-semibold">Service</span>
                     </div>
                     <div>
                        <select id="service_type_id" name="service_type_id"
                           class="select select-2 select-bordered w-full form-control flex-row" data-placeholder="">
                           <option value="" hidden></option>
                           @foreach ($serviceTypes as $serviceType)
                              <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </label>

                  <label class="form-control w-full">
                     <div class="label">
                        <span class="label-text font-semibold">Tanggal Pertemuan</span>
                     </div>

                     <input type="text" name="appointment_date" class="input input-bordered w-full date-picker"
                        readonly />
                  </label>

                  <label class="form-control w-full lg:col-span-3">
                     <div class="label">
                        <span class="label-text font-semibold">Keluhan</span>
                     </div>
                     <textarea name="appointment_note" class="textarea textarea-bordered w-full form-validation"></textarea>
                  </label>
               </div>
               <div class="flex justify-end">
                  <button type="submit" class="btn btn-primary btn-padding stepper_next">Submit</button>
               </div>
            </form>
         </div>
      </div>


   </section>
@endsection

@section('js-footer')
   <script></script>
@endsection
