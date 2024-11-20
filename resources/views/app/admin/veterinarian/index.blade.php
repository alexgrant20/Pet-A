@extends('layouts.master.layout')

@section('title', 'Veterinarian')

@section('content')
   <div class="card bg-base-200 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Veterinarian</h1>
            {{ Breadcrumbs::render('veterinarian') }}
         </div>
         <div>
            <a href="{{ route('admin.veterinarian.create') }}" class="btn btn-primary btn-padding">Add Veterinarian <i
                  class="fa fa-solid fa-plus"></i></a>
         </div>
      </div>
   </div>

   <div class="card bg-base-200 shadow-xl w-full">
      <div class="card-body">
         <div class="flex flex-row gap-4">
            <div class="grid grid-cols-1 xl:grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-5 w-full">
               @foreach ($veterinarians as $veterinarian)
                  <div class="card bg-base-100 shadow-2xl w-full p-0">
                     <div class="flex pt-4 px-5 pb-4 border-2 border-base-100 rounded-t-xl border-b-gray-400">
                        <div class="mr-3">
                           <img class="mt-4 ml-3 w-14 h-14 object-cover rounded-full"
                              src="{{ asset($veterinarian->attachment->first()->path) }}" alt="">
                        </div>

                        <div class="flex flex-col justify-center">
                           <h2 class="text-center font-sm font-bold xl:text-start">{{ $veterinarian->user->name }}</h2>

                           @php
                              $rating = round($veterinarian->ratings()->avg('rating'), 1);
                           @endphp

                           <div class="badge bg-yellow-500 text-white py-3">
                              <i class="fa-solid fa-star"></i>
                              <span class="ms-1 font-semibold"> {{ $rating == 0 ? 'N\A' : $rating }}</span>
                           </div>
                        </div>
                     </div>
                     <div class="card-body bg-slate-50">
                        <div class="flex item-center justify-center xl:justify-start gap-1">
                           <div>
                              <i class="fa-solid fa-paw"></i>
                           </div>
                           <div>
                              @foreach ($veterinarian->petType as $petType)
                                 <div class="badge badge-primary">
                                    {{ $petType->name }}
                                 </div>
                              @endforeach
                           </div>
                        </div>

                        <div class="flex item-center justify-center xl:justify-start gap-1">
                           <div>
                              <i class="fa-solid fa-briefcase-medical"></i>
                           </div>
                           <div>
                              <span>{{ $veterinarian->length_of_service }} years</span>
                           </div>
                        </div>

                        <div class="flex item-center justify-center xl:justify-start gap-1">
                           <div>
                              <i class="fa fa-hospital"></i>
                           </div>
                           <div>
                              <span>{{ $veterinarian->clinic->name }}</span>
                           </div>
                        </div>
                     </div>
                     <a href="{{ route('admin.veterinarian.edit', $veterinarian->id) }}"
                        class="btn bg-primary mx-0 w-full py-4 text-white text-lg rounded-t-none rounded-b-xl">
                        Edit Data
                        <i class="fa-pencil fa-solid"></i>
                     </a>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="text-end">
            {{ $veterinarians->links() }}
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script></script>

@endsection
