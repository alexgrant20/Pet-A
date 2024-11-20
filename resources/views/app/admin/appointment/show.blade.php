@extends('layouts.master.layout')
@section('title', 'Appointment Detail')

@php
   $medicalRecordCount = $appointment->pet->medicalRecord()->count();
   $vacinnationCount = $appointment->pet->petVaccination()->count();
@endphp

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Appointment Detail</h1>
            {{ Breadcrumbs::render('appointment-show') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <div class="w-full flex flex-col sm:flex-row gap-5 mb-2">
            <div class="flex items-center justify-center px-5">
               <div class="relative">
                  <img id="pet_owner_image_preview" class="w-36 h-36 rounded-full object-cover unselectable"
                     src="{{ asset($appointment->petOwner->attachment->first()?->path) }}" alt="pet owner image">
               </div>
            </div>

            <div class="md:gap-5 lg:gap-20">
               <div class="w-full mb-1 gap-2 mb-2">
                  <div class="col-span-3 font-bold">
                     <span>{{ ucwords($appointment->petOwner->user->name) }}</span>
                  </div>
               </div>

               <div class="w-full text-sm mb-1 gap-2 mb-3">
                  <span><i class="fa-solid fa-phone text-primary mr-1 sm:block"></i>
                     {{ $appointment->petOwner->user->phone_number }}</span>
                  <span class="text-gray-300 mx-2">•</span>
                  <span><i class="fa-solid fa-envelope text-primary mr-1"></i>
                     {{ $appointment->petOwner->user->email }}</span>
               </div>

               <div class="w-full mb-1 gap-2 mb-3">
                  <span class="uppercase font-bold text-xs text-primary">Address</span>
                  <div class="col-span-3">
                     <span> {{ $appointment->petOwner->address }}</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="w-full mb-1 gap-2 mb-3 py-3 px-4 bg-gray-100 rounded-lg">
            <span class="uppercase font-bold text-xs text-gray-500">Reason of Visit</span>
            <div class="col-span-3">
               <span>{{ $appointment->appointment_note }}</span>
            </div>
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5 flex">
            <div class="w-fit flex gap-2 mb-3 inline">
               <div class="flex pb-5">
                  <i class="text-lg fa-solid fa-calendar-clock bg-gray-100 rounded-lg p-4 text-gray-600 h-12"></i>
               </div>
               <div class="w-full col-span-2">
                  <span class="font-bold uppercase text-gray-400 text-xs block">Date and time</span>
                  <div>
                     <span class="font-bold block">{{ $appointment->appointment_date->format('l, d F Y') }}</span>
                     <span class="font-bold block">{{ $appointment->getAppointmentTime() }}</span>
                  </div>
               </div>
            </div>

            <div class="w-fit flex gap-2 mb-3 inline">
               <div class="flex items-center pb-5">
                  <i
                     class="text-xl text-center fa-regular fa-stethoscope bg-gray-100 rounded-lg p-4 text-gray-600 h-12"></i>
               </div>
               <div class="w-full col-span-2">
                  <span class="font-bold uppercase text-gray-400 text-xs block">Service</span>
                  <span class="font-bold">{{ $appointment->serviceType->name }}</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
      <div class="card bg-base-100 shadow-xl w-full">
         <div class="card-body">
            <div class="flex flex-col sm:flex-row items-center sm:justify-center gap-5 mb-5">
               <div class="flex flex-col gap-5 px-5">
                  <div class="relative">
                     <img id="pet_image_preview" class="w-36 h-36 rounded-full object-cover unselectable"
                        src="{{ asset($appointment->pet->attachment->first()?->path) }}" alt="pet image">
                  </div>
               </div>

               <div class="flex flex-row gap-8 sm:gap-20 flex-1">
                  <div>
                     <div class="w-full mb-1 gap-2 mb-3">
                        <span class="uppercase font-bold text-xs text-primary">Name</span>
                        <div class="col-span-3">
                           <span>{{ $appointment->pet->name }}</span>
                        </div>
                     </div>

                     <div class="w-full mb-1 gap-2 mb-3">
                        <span class="uppercase font-bold text-xs text-primary">Age</span>
                        <div class="col-span-3">
                           <span>{{ $appointment->pet->getAge() }}</span>
                        </div>
                     </div>

                     <div class="w-full mb-1 gap-2 mb-3">
                        <span class="uppercase font-bold text-xs text-primary">Breed</span>
                        <div class="col-span-3">
                           <span>{{ $appointment->pet->breed->name }}</span>
                        </div>
                     </div>
                  </div>

                  <div>
                     <div class="w-full mb-1 gap-2 mb-3">
                        <span class="uppercase font-bold text-xs text-primary">Sex</span>
                        <div class="col-span-3">
                           <span>
                              @if ($appointment->pet->gender == 'm')
                                 Male
                              @else
                                 Female
                              @endif
                           </span>
                        </div>
                     </div>

                     <div class="w-full mb-1 gap-2 mb-3">
                        <span class="uppercase font-bold text-xs text-primary">Weight</span>
                        <div class="col-span-3">
                           <span>{{ $appointment->pet->weight }}</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            @if (is_null($appointment->finished_at))
               <div class="text-center w-full">
                  <a href="#appointment_summary_form" class="btn btn-primary btn-padding text-sm w-full">
                     <i class="fa-regular fa-pen-to-square"></i>
                     Add
                     @if ($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_VAKSINASI)
                        Vaccination
                     @else
                        Appointment Summary
                     @endif
                  </a>
               </div>
            @endif
         </div>
      </div>

      <div class="card bg-base-100 shadow-xl w-full">
         <div class="card-body">
            <h3 class="font-bold text-lg mb-3 text-primary">Allergy Information</h3>
            <div
               class="grid grid-flow-row gap-y-4 {{ $appointment->pet->petAllergy->count() > 3 ?: 'grid-rows-3' }} overflow-y-auto h-48 no-scrollbar">
               @forelse ($appointment->pet->petAllergy as $petAllergy)
                  <div class="card row-span-1">
                     <div class="card-body flex-row p-0 gap-4 items-center justify-start">
                        <div
                           class="bg-{{ $petAllergy->allergyCategory->color_class }} rounded-full text-white flex items-center justify-center w-10 h-10">
                           <i class="{{ $petAllergy->icon->name }}"></i>
                        </div>

                        <div class="flex flex-col gap-2">
                           <div class="text-gray-900 font-bold">
                              {{ $petAllergy->name }}
                           </div>
                        </div>

                        <div class="ms-auto text-{{ $petAllergy->allergyCategory->color_class }}">
                           {{ $petAllergy->allergyCategory->name }}
                        </div>
                     </div>
                  </div>
               @empty
                  <div class="row-span-3 flex flex-col items-center justify-end gap-2">
                     <img class="max-h-40" src="{{ asset('assets/no-disease.svg') }}" alt="healthy">
                     <div class="font-semibold">{{ $appointment->pet->name }} Has No Allergy</div>
                  </div>
               @endforelse
            </div>
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <h3 class="font-bold text-lg mb-4 text-primary">Medical Record</h3>
         <div class="px-4">
            @if ($appointment->pet->medicalRecord->isEmpty())
               <div class="row-span-3 flex flex-col items-center justify-end gap-2">
                  <img class="max-h-40" src="{{ asset('assets/no-disease.svg') }}" alt="healthy">
                  <div class="font-semibold">{{ $appointment->pet->name }} Has No Medical Record</div>
               </div>
            @else
               <ul class="timeline timeline-compact timeline-vertical">
                  @foreach ($appointment->pet->medicalRecord as $item)
                     <li class="gap-x-2">
                        @if (!$loop->first)
                           <hr class="bg-primary" />
                        @endif
                        <div class="timeline-middle">
                           <i class="fa-solid fa-circle text-primary"></i>
                        </div>
                        <div class="timeline-end timeline-box shadow-md mb-5 w-full p-2">
                           <div class="flex flex-row gap-3">
                              <div class="py-3">
                                 <div class="w-20 px-3 text-sm font-bold border-r-2 text-primary">
                                    <span
                                       class="uppercase block">{{ $item->appointment->appointment_date->format('M d') }}</span>
                                    <span>{{ $item->appointment->appointment_date->format('Y') }}</span>
                                 </div>
                              </div>
                              <div class="p-3 md:w-full">
                                 <div class="flex md:w-3/5 grid-cols-3 gap-12 xl:gap-32 md:gap-30">
                                    <div class=" mb-1 gap-2 mb-3">
                                       <span class="uppercase font-bold text-xs text-primary">Disease</span>
                                       <div class="col-span-3">
                                          <span>{{ $item->disease_name ?? 'None' }}</span>
                                       </div>
                                    </div>
                                    <div class="mb-1 gap-2 mb-3">
                                       <span class="uppercase font-bold text-xs text-primary">Medicine</span>
                                       <div class="col-span-3">
                                          <span>{{ $item->medicine_name ?? 'None' }}</span>
                                       </div>
                                    </div>
                                    <div class="mb-1 gap-2 mb-3">
                                       <span class="uppercase font-bold text-xs text-primary">Veterinarian</span>
                                       <div class="col-span-3">
                                          <span>{{ $item->veterinarian_name }}</span>
                                       </div>
                                    </div>
                                 </div>

                                 @if ($item->appointment->summary)
                                    <div class="md:w-full mb-1 gap-2 mb-3 py-3 px-4 bg-gray-100 rounded-lg">
                                       <span class="uppercase font-bold text-xs text-gray-500">
                                          <i class="fa-solid fa-pen-to-square mr-1"></i>
                                          Summary
                                       </span>
                                       <div class="col-span-3">
                                          <span>{{ $item->appointment->summary }}</span>
                                       </div>
                                    </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @if (!$loop->last && $medicalRecordCount > 1)
                           <hr class="bg-primary" />
                        @endif
                     </li>
                  @endforeach
               </ul>
            @endif
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <h3 class="font-bold text-lg mb-4 text-primary">Vaccination History</h3>
         <div>
            @if ($appointment->pet->petVaccination->isEmpty())
               <div class="row-span-3 flex flex-col items-center justify-end gap-2">
                  <img class="max-h-40" src="{{ asset('assets/no-vaccination.svg') }}" alt="healthy">
                  <div class="font-semibold">{{ $appointment->pet->name }} Has No Vaccination History</div>
               </div>
            @else
               <ul class="timeline timeline-compact timeline-vertical">
                  @foreach ($appointment->petVaccination as $givenAt => $item)
                     <li class="gap-x-2">
                        @if (!$loop->first)
                           <hr class="bg-primary" />
                        @endif
                        <div class="timeline-middle">
                           <i class="fa-solid fa-circle text-primary"></i>
                        </div>
                        <div class="timeline-end timeline-box shadow-md mb-5 w-full">
                           <div class="p-3 w-full">
                              <div class="flex w-3/5 grid-cols-2 gap-12 xl:gap-32 md:gap-30">
                                 <div class="w-full mb-1 gap-2 mb-3">
                                    <span class="uppercase font-bold text-xs text-primary">Given At</span>
                                    <div class="col-span-3">
                                       <span>{{ $item->first()->getGivenAtAttribute($givenAt, 'd F Y') }}</span>
                                    </div>
                                 </div>
                                 <div class="w-full mb-1 gap-2 mb-3">
                                    <span class="uppercase font-bold text-xs text-primary">Given By</span>
                                    <div class="col-span-3">
                                       <span>{{ ucwords($item->first()->given_by) }}</span>
                                    </div>
                                 </div>
                              </div>

                              <div class="flex md:flex-row flex-col">
                                 <div class="mb-1 gap-2 mb-3 py-3 px-4 bg-gray-100 rounded-lg w-full md:w-1/4">
                                    <span class="uppercase font-bold text-xs text-gray-500">
                                       <i class="fa-solid fa-syringe mr-1"></i>
                                       Vaccination
                                    </span>
                                    <div class="p-1">
                                       @foreach ($vaccinations as $vaccination)
                                          <div class="flex gap-1 items-center">
                                             <input type="checkbox" value="{{ Crypt::encrypt($vaccination->id) }}"
                                                disabled @checked($item->contains('vaccination_id', $vaccination->id))>
                                             <label for="vaccination-checkbox"
                                                class="text-xs font-bold uppercase">{{ $vaccination->name }}</label><br>
                                          </div>
                                       @endforeach
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @if (!$loop->last && $medicalRecordCount > 1)
                           <hr class="bg-primary" />
                        @endif
                     </li>
                  @endforeach
               </ul>
            @endif
         </div>
      </div>
   </div>

   <section class="card bg-base-100 shadow-xl w-full" id="appointment_summary_form">
      <div class="card-body">
         <h3 class="font-bold text-lg mb-4 text-primary">
            Add
            @if ($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_VAKSINASI)
               Vaccination
            @else
               Appointment Summary
            @endif
         </h3>
         <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST"
            id="appointment_form">
            @csrf
            @method('PUT')

            @if ($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_VAKSINASI)
               <div class="flex gap-5 md:flex-row flex-col">
                  <div class="form-control w-full md:w-1/4 mb-3">
                     <div class="label">
                        <span class="font-bold uppercase text-primary text-xs">Vaccinations</span>
                     </div>
                     <div class="p-3 rounded-lg border-2 border-primary">
                        @foreach ($vaccinations as $vaccination)
                           <div class="flex gap-1 items-center">
                              <input type="checkbox" id="vaccination-checkbox_{{ $loop->index }}"
                                 name="vaccination[{{ $loop->index }}]"
                                 value="{{ Crypt::encrypt($vaccination->id) }}">
                              <label for="vaccination-checkbox_{{ $loop->index }}"
                                 class="text-xs font-bold uppercase">{{ $vaccination->name }}</label><br>
                           </div>
                        @endforeach
                     </div>
                  </div>

                  <div class="w-full">
                     <div class="flex gap-3 mb-3 md:flex-row flex-col">
                        <div class="form-control w-full">
                           <div class="label">
                              <span class="font-bold uppercase text-primary text-xs">Pet Weight</span>
                           </div>
                           <div>
                              <input type="text" name="weight" value="{{ old('pet_weight') }}"
                                 class="input input-bordered h-9 border-2 border-primary border-2 border-primary w-full form-validation" />
                           </div>
                        </div>
                        <div class="w-full md:w-1/4">
                           <div class="label">
                              <span class="font-bold uppercase text-primary text-xs">Weight Unit</span>
                           </div>
                           <select name="weight_unit" id="weight_unit"
                              class="border border-primary h-9 rounded-lg bg-transparent border-2 w-full form-validation">
                              <option hidden selected></option>
                              <option value="g" @selected(old('weight_unit') == 'g')>Gram</option>
                              <option value="kg" @selected(old('weight_unit') == 'kg')>Kilogram</option>
                           </select>
                        </div>
                     </div>

                     <div class="flex gap-3 mb-3 md:flex-row flex-col">
                        <div class="form-control w-full">
                           <div class="label">
                              <span class="font-bold uppercase text-primary text-xs">Next Vaccination in</span>
                           </div>
                           <div>
                              <input type="text" name="next_vaccination" value="{{ old('next_vaccination') }}"
                                 class="input input-bordered h-9 border-2 border-primary border-2 border-primary w-full form-validation" />
                           </div>
                        </div>
                        <div class="md:pt-8 w-full md:w-1/4">
                           <select name="next_vaccination_unit" id="next_vaccination_unit"
                              class="border border-primary h-9 rounded-lg bg-transparent border-2 w-full form-validation">
                              <option hidden selected></option>
                              <option value="month" @selected(old('next_vaccination_unit') == 'month')>Month</option>
                              <option value="year" @selected(old('next_vaccination_unit') == 'year')>Year</option>
                           </select>
                        </div>
                     </div>

                     {{-- <div class="form-control w-full mb-3">
                        <div class="label">
                           <span class="text-primary text-xs uppercase font-bold">Summary</span>
                        </div>
                        <textarea class="textarea textarea-bordered border-2 border-primary" name="summary" placeholder="" rows="2"></textarea>
                     </div> --}}
                     <div class="text-right mt-12">
                        <button type="submit" class="btn btn-primary btn-padding">Submit</button>
                     </div>
                  </div>
               </div>
            @elseif($appointment->service_type_id == ServiceTypeInterface::SERVICE_TYPE_KONSULTASI)
               <div class="flex gap-3 md:flex-row flex-col mb-3">
                  <div class="form-control w-full">
                     <div class="label">
                        <span class="font-bold uppercase text-primary text-xs">Pet Weight</span>
                     </div>
                     <div>
                        <input type="text" name="weight" value="{{ old('pet_weight') }}"
                           class="input input-bordered h-9 border-2 border-primary border-2 border-primary w-full form-validation" />
                     </div>
                  </div>
                  <div class="w-full md:w-1/4">
                     <div class="label">
                        <span class="font-bold uppercase text-primary text-xs">Weight Unit</span>
                     </div>
                     <select name="weight_unit" id="weight_unit"
                        class="border border-primary h-9 rounded-lg bg-transparent border-2 w-full form-validation">
                        <option hidden selected></option>
                        <option value="g" @selected(old('weight_unit') == 'g')>Gram</option>
                        <option value="kg" @selected(old('weight_unit') == 'kg')>Kilogram</option>
                     </select>
                  </div>
               </div>
               <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                  <div class="form-control w-full">
                     <div class="label">
                        <span class="font-bold uppercase text-primary text-xs">Disease</span>
                     </div>
                     <input type="text" name="disease_name" value="{{ old('disease_name') }}"
                        class="input input-bordered h-9 border-2 border-primary w-full form-validation"
                        value="{{ old('disease_name') }}" />
                  </div>

                  <div class="form-control w-full">
                     <div class="label">
                        <span class="text-primary text-xs uppercase font-bold">Medicine</span>
                     </div>
                     <input type="text" name="medicine_name" value="{{ old('medicine_name') }}"
                        class="input input-bordered h-9 border-2 border-primary w-full form-validation" />
                  </div>

                  <div class="form-control w-full">
                     <div class="label">
                        <span class="text-primary text-xs uppercase font-bold">Dosage</span>
                     </div>
                     <input type="text" name="medicine_dosage" value="{{ old('medicine_dosage') }}"
                        class="input input-bordered h-9 border-2 border-primary w-full form-validation" />
                  </div>
               </div>

               <div class="form-control w-full mb-3">
                  <div class="label">
                     <span class="text-primary text-xs uppercase font-bold">Medicine Notes</span>
                  </div>
                  <textarea class="textarea textarea-bordered border-2 border-primary" name="note" placeholder="">{{ old('note') }}</textarea>
               </div>

               <div class="form-control w-full mb-3">
                  <div class="label">
                     <span class="text-primary text-xs uppercase font-bold">Summary</span>
                  </div>
                  <textarea class="textarea textarea-bordered border-2 border-primary" name="summary" placeholder="">{{ old('summary') }}</textarea>
               </div>

               <div class="text-right">
                  <button type="submit" class="btn btn-primary btn-padding">Submit</button>
               </div>
            @endif

         </form>
      </div>
   </section>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateAppointmentRequest', '#appointment_form') !!}
@endsection