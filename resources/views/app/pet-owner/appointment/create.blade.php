@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section>
      <div class="flex justify-between">
         <h2 class="text-primary text-2xl font-bold">Tambahkan Appointment</h2>
      </div>


      <form action="#" class="pet_basic_detail_form" enctype="multipart/form-data">
         <div class="grid grid-cols-3 gap-3 mb-5">
            <label class="form-control w-full">
               <div class="label">
                  <span class="label-text font-semibold">Hewan Peliharaan</span>
               </div>
               <div>
                  <select id="service_type_id" name="service_type_id"
                     class="select select-2 select-bordered w-full form-control flex-row">
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
                     class="select select-2 select-bordered w-full form-control flex-row">
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
               <input type="date" name="appointment_date" class="input input-bordered w-full" />
            </label>

            <label class="form-control w-full col-span-3">
               <div class="label">
                  <span class="label-text font-semibold">Keluhan</span>
               </div>
               <textarea name="appointment_note" class="input input-bordered w-full form-validation"></textarea>
            </label>
         </div>
         <div class="flex justify-end">
            <button type="submit" class="btn btn-primary btn-padding stepper_next">Lanjutkan <i
                  class="fa fa-paw"></i></button>
         </div>
      </form>


   </section>
@endsection

@section('js-footer')
   <script>
   </script>
@endsection
