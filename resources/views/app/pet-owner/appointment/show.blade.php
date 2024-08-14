@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section class="px-5 py-10">

      <div class="flex flex-col items-center justify-center">
         <img class="w-24 h-24 rounded-full mb-3" src="{{ asset($appointment->veterinarian->attachment->first()->path) }}"
            alt="">
         <h1 class="text-3xl font-bold text-gray-800">{{ $appointment->veterinarian->user->name }}</h1>

         <div class="flex flex-row gap-1 mb-5">
            <div class="badge badge-primary rounded-full font-bold">Anjing</div>
         </div>

         <div class="w-full lg:w-1/2 text-center text-gray-500">
            {{ $appointment->veterinarian->clinic->name }}
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
                  <div class="text-gray-800 font-bold">{{ $appointment->veterinarian->length_of_service }} Years</div>
               </div>
            </div>
            <div class="flex items-center gap-3">
               <div class="w-8 h-8 flex items-center justify-center bg-gray-300  rounded-full">
                  <i class="fa-solid fa-star text-gray-600"></i>
               </div>
               <div>
                  @php
                     $rating = round($appointment->veterinarian->ratings()->avg('rating'), 1);
                  @endphp
                  <div class="text-gray-400">Rating</div>
                  <div class="text-gray-800 font-bold">{{ $rating == 0 ? 'N\A' : $rating }}
                     ({{ $appointment->veterinarian->ratings()->count() }})</div>
               </div>
            </div>
         </div>
      </div>

      @if ($appointment->finished_at)
         <div class="card mb-5">
            <div class="card-body bg-base-100 shadow-xl flex items-center p-4">
               <label class="font-bold" for="rating">Rate this appointment</label>
               <div class="star-rating mb-3">
                  @for ($i = 1; $i <= 5; $i++)
                     <i class="fa fa-star star-icon fa-2x" id="star-{{ $i }}"
                        data-value="{{ $i }}"></i>
                  @endfor
               </div>

               <form action="{{ route('pet-owner.appointment.give.rating') }}" method="POST">
                  @csrf
                  <input type="hidden" name="rating" id="rating">
                  <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

                  <div class="flex justify-center">
                     <button class="btn btn-primary btn-padding hidden submit_rating" type="submit">
                        Submit
                     </button>
                  </div>
               </form>
            </div>
         </div>

         <div class="card mb-5">
            <div class="card-body bg-base-100 shadow-xl p-4">
               <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                  <label class="w-full">
                     <span class="label-text font-bold mb-2">Kesimpulan</span>

                     <div class="w-full">
                        {{ $appointment->summary ?? 'Tidak Ada Catatan' }}
                     </div>
                  </label>
               </div>
            </div>
         </div>
      @endif

      <div class="card mb-5">
         <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl grid lg:grid-cols-2 gap-3">
            <label class="form-control w-full">
               <span class="label-text font-bold mb-2">Tanggal Pertemuan</span>

               <div class="w-full">
                  {{ $appointment->appointment_date->isoFormat('dddd, D MMMM Y') }}
               </div>
            </label>

            <div>
               <span class="label-text font-bold mb-2">Jam</span>

               <div class="w-full">
                  {{ $appointment->appointmentSchedule->start_time }}
               </div>
            </div>
         </div>
      </div>

      <div class="card mb-5">
         <div class="card-body bg-base-100 shadow-xl p-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-5">
               <label class="form-control w-full">
                  <span class="label-text font-bold mb-2">Hewan Peliharaan</span>

                  <div class="w-full">
                     {{ $appointment->pet->name }}
                  </div>
               </label>

               <label class="form-control w-full">
                  <span class="label-text font-bold mb-2">Service</span>

                  <div class="w-full">
                     {{ $appointment->serviceType->name }}
                  </div>
               </label>

               <label class="form-control w-full lg:col-span-2">
                  <span class="label-text font-bold mb-2">Keluhan</span>

                  <div class="w-full">
                     {{ $appointment->appointment_note }}
                  </div>
               </label>
            </div>
         </div>
      </div>
   </section>
@endsection

@section('js-footer')
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const ratingValue = @json($appointment->rating);
         const stars = document.querySelectorAll('.star-icon');

         if(ratingValue) {
            $('form').remove();
            updateStars(ratingValue.rating);
         } else {
            stars.forEach((star) => {
               star.addEventListener('click', function() {
                  $('.submit_rating').show();
                  const rating = this.getAttribute('data-value');
                  document.getElementById('rating').value = rating;
                  updateStars(rating);
               });

               star.addEventListener('mouseover', function() {
                  const rating = this.getAttribute('data-value');
                  updateStars(rating);
               });

               star.addEventListener('mouseout', function() {
                  const rating = document.getElementById('rating').value;
                  updateStars(rating);
               });
            });
         }

         function updateStars(rating) {
            stars.forEach((star, index) => {
               if (index < rating) {
                  star.classList.add('text-yellow-600');
               } else {
                  star.classList.remove('text-yellow-600');
               }
            });
         }
      });
   </script>
@endsection
