@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
   <div class="h-full">
      <div class="flex flex-col h-full gap-5 justify-start items-start lg:flex-row">
         <section class="flex justify-stretch bg-white bg-opacity-25 h-fit w-full xl:w-fit lg:h-full">
            <div class="card flex-1">
               <div class="card-body rounded shadow-2xl pet_detail_container w-full">
                  <div class="container_pet_detail w-full flex flex-col items-center relative">
                     <div class="absolute right-0">
                        <a href="{{ route('pet-owner.pet.edit', $pet->id) }}" class="cursor-pointer">
                           <i class="fa-solid fa-pen-circle fa-2x text-primary"></i>
                        </a>
                     </div>
                     <img class="rounded-full w-36 h-36 pet_image border border-gray-400 mb-5"
                        src="{{ asset($pet?->thumbnail_image) }}" alt="">
                     <div>
                        <h1 class="text-3xl font-bold pet_name text-center">{{ $pet->name }}</h1>
                        <h2 class="pet_breed text-2xl text-gray-400 text-center">{{ $pet->breed->name }}</h2>
                     </div>

                     <div class="mt-8 flex flex-row justify-center gap-3 text-lg">
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-primary font-bold">Age</span>
                           <span class="text-gray-900 font-bold">{{ $pet->getAge() }}</span>
                        </div>
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-primary font-bold">Weight</span>
                           <span class="text-gray-900 font-bold pet_weight">{{ $pet->weight }}</span>
                        </div>
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-primary font-bold">Sex</span>
                           <span class="text-gray-900 font-bold pet_gender">{{ $pet->gender }}</span>
                        </div>
                     </div>

                     <div class="w-full mt-12">
                        <div class="flex justify-between items-center mb-5 w-full">
                           <span class="font-bold">Appointment History</span>
                        </div>

                        <div class="grid grid-rows-{{ $pet?->history_appointment->count() }}">
                           @forelse ($pet?->history_appointment->all() ?? [] as $appointment)
                              <a
                                 href="{{ route('pet-owner.appointment.show', $appointment->id) }}"
                                 class="border-b-2 flex py-4 px-2 gap-6 items-center justify-evenly hover:border-secondary transition-colors duration-300">
                                 <div>
                                    <i
                                       class="fa-solid fa-syringe p-3 bg-secondary rounded-full text-white text-opacity-95"></i>
                                 </div>
                                 <div class="flex flex-col">
                                    <span class="text-gray-900 font-semibold">
                                       {{ $appointment->serviceType->name }}
                                    </span>
                                    <span
                                       class="text-gray-400 uppercase">{{ $appointment->veterinarian->user->name }}</span>
                                 </div>
                                 <div class="text-gray-400 text-sm">
                                    {{ $appointment->appointment_date->format('d-m-Y') }}
                                 </div>
                              </a>
                           @empty
                           <a href="{{ route('pet-owner.appointment.index') }}" class="border border-gray-400 hover:border-primary hover:text-primary cursor-pointer shadow rounded-full flex py-4 px-2 items-center justify-evenly">
                              <i class="fa-light fa-shield-dog fa-2x"></i>
                              <div>Meet Our Professional Veterinarian</div>
                           </a>
                           @endforelse
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <div class="w-full px-5 py-10 xl:ps-0">
            <div>
               <div class="mb-5 w-full">
                  <span class="font-bold text-2xl">Pet Health Condition</span>
               </div>
               <div class="grid grid-cols-1 2xl:grid-cols-2 2xl:grid-rows-2 gap-5">
                  <section>
                     <x-pet-owner.card
                        titleLink="{{ route('pet-owner.pet.edit', ['pet' => $pet->id ?? '#', 'step' => 2]) }}"
                        title='Allergy Information' :totalAllergy="$pet?->petAllergy->count()">
                        <div
                           class="grid grid-flow-row gap-y-4 {{ $pet?->petAllergy->count() > 3 ?: 'grid-rows-3' }} overflow-y-auto h-48 no-scrollbar">
                           @forelse ($pet?->petAllergy->all() ?? [] as $petAllergy)
                              <div class="card row-span-1">
                                 <div class="card-body flex-row p-0 gap-4 items-center justify-start">
                                    <div
                                       class="bg-secondary rounded-full text-white flex items-center justify-center w-10 h-10">
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
                                 <div class="font-semibold">{{ $pet?->name }} has no allergy</div>
                              </div>
                           @endforelse
                        </div>
                     </x-pet-owner.card>
                  </section>

                  <section>
                     <x-pet-owner.card
                        titleLink="{{ route('pet-owner.pet.edit', ['pet' => $pet->id ?? '#', 'step' => 3]) }}"
                        title='Medical Record' :totalAllergy="$pet?->medicalRecord->count()">
                        <div
                           class="grid grid-flow-row gap-y-4 {{ $pet?->medicalRecord->count() > 3 ?: 'grid-rows-3' }}  overflow-y-auto h-48 no-scrollbar">
                           @forelse ($pet?->medicalRecord->all() ?? [] as $medicalRecord)
                              <div class="card row-span-1">
                                 <div
                                    class="card-body flex-row p-0 gap-4 items-center justify-start border-l-4 border-primary ps-2">
                                    <div class="flex flex-col">
                                       <div class="text-gray-900 font-bold">
                                          {{ $medicalRecord->disease_name }}
                                       </div>
                                       <div class="flex items-center gap-2">
                                          <span
                                             class="text-gray-400 uppercase">{{ $medicalRecord->veterinarian_name }}</span>
                                       </div>
                                    </div>
                                    <div class="ms-auto text-gray-400">
                                       {{ $medicalRecord->created_at }}
                                    </div>
                                 </div>
                              </div>
                           @empty
                              <div class="row-span-3 flex flex-col items-center justify-end gap-2">
                                 <img class="max-h-40" src="{{ asset('assets/no-disease.svg') }}" alt="healthy">
                                 <div class="font-semibold">{{ $pet?->name }} has no medical record</div>
                              </div>
                           @endforelse
                        </div>
                     </x-pet-owner.card>

                  </section>

                  <section>
                     <x-pet-owner.card title='Vaccination'
                        titleLink="{{ route('pet-owner.pet.edit', ['pet' => $pet->id ?? '#', 'step' => 3]) }}"
                        :totalAllergy="$pet?->petVaccination->count()">
                        <div
                           class="grid grid-flow-row gap-y-2 {{ $pet?->petVaccination->count() > 3 ?: 'grid-rows-3' }} overflow-y-auto h-48 no-scrollbar">
                           @forelse ($pet?->petVaccination->all() ?? [] as $petVaccination)
                              <div class="card">
                                 <div
                                    class="card-body flex-row p-0 gap-4 items-center justify-start border-l-4 border-primary ps-2">
                                    <div class="flex flex-col">
                                       <div class="text-gray-900 font-bold">
                                          {{ $petVaccination->vaccination->name }}
                                       </div>
                                       <div class="flex items-center gap-2">
                                          <span class="text-gray-400">{{ $petVaccination?->given_by }}</span>
                                       </div>
                                    </div>
                                    <div class="ms-auto text-gray-400">
                                       {{ $petVaccination?->given_at }}
                                    </div>
                                 </div>
                              </div>
                           @empty
                              <div class="flex flex-col items-center justify-end gap-2 row-span-3">
                                 <img class="max-h-40" src="{{ asset('assets/no-vaccination.svg') }}" alt="healthy">
                                 <div class="font-semibold">{{ $pet?->name }} belum vaksin nih</div>
                              </div>
                           @endforelse
                        </div>
                     </x-pet-owner.card>
                  </section>

                  <section>
                     <div class="card h-full">
                        <div class="card-body p-4 bg-white/35 shadow-xl rounded-xl">
                           <div class="flex justify-between items-center mb-2 w-full">
                              <div class="text-gray-600">
                                 <span class="me-1 font-bold">Weight Chart (Kg)</span>
                              </div>
                           </div>
                           <div class="w-full overflow-x-auto h-full">
                              <div class="w-full h-full">
                                 <canvas class="w-0 h-full max-h-52" id="acquisitions"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>

            <section class="pt-5">
               <div class="flex justify-between items-center mb-5 w-full">
                  <span class="font-bold text-xl">Future Appointment</span>
               </div>

               <div class="grid grid-rows-3 gap-5">
                  @forelse ($pet?->future_appointment->all() ?? [] as $appointment)
                     <a href="{{ route('pet-owner.appointment.show', $appointment->id) }}" class="card">
                        <div
                           class="card-body bg-white/65 shadow-xl rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-300">
                           <div class="px-8 py-4 flex flex-col font-bold items-center justify-center border-r-2 h-full">
                              <span class="text-primary">{{ $appointment->appointment_date->format('M') }}</span>
                              <span>{{ $appointment->appointment_date->format('d') }}</span>
                           </div>
                           <div class="py-4 flex flex-col gap-2">
                              <div class="text-gray-900 font-semibold">
                                 {{ $appointment->veterinarian->user->name }}
                              </div>
                              <div class="flex items-center gap-2">
                                 <i class="fa-solid fa-clock text-gray-400"></i>
                                 <span
                                    class="text-gray-900">{{ $appointment->appointmentSchedule->start_time }}</span>
                              </div>
                           </div>
                           <div class="ms-auto pe-4 text-transparent group-hover:text-primary duration-500">
                              <i class="fa-solid fa-arrow-right text-lg"></i>
                           </div>
                        </div>
                     </a>
                  @empty
                     <div class="card">
                        <a href="{{ route('pet-owner.appointment.index') }}"
                           class="card-body border-2 border-primary border-dashed shadow rounded-xl gap-5 items-center justify-center p-5">
                           <i class="fa-solid fa-plus bg-primary bg-opacity-70 p-4 rounded-full text-white"></i>
                           <span class="font-bold text-gray-700">Adakan Pertemuan Dengan Dokter Kami</span>
                        </a>
                     </div>
                  @endforelse
               </div>
            </section>
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      (async function() {
         const petWeight = @json(@$pet->petWeight);
         const pet = @json($pet);
         const labels = [];
         const weight = [];
         const upperBoundValue = pet.breed.maximum_weight;
         const lowerBoundValue = pet.breed.minimum_weight;

         petWeight.forEach(function(data) {
            labels.push(new Date(data.created_at).toLocaleDateString("en-US"));
            weight.push(data.weight);
         });

         var ctx = document.getElementById('acquisitions').getContext('2d');

         new Chart(
            ctx, {
               type: 'line',
               data: {
                  labels,
                  datasets: [{
                        data: Array(labels.length).fill(upperBoundValue),
                        label: "Upper Bound",
                        borderColor: "#7D7D7D",
                        backgroundColor: '#7D7D7D',
                        fill: false,
                        pointRadius: 0
                     },
                     {
                        data: weight,
                        label: "Berat",
                        borderColor: "#2ECC71",
                        backgroundColor: '#2ECC71',
                        fill: false,
                        pointRadius: 3
                     },
                     {
                        data: Array(labels.length).fill(lowerBoundValue),
                        label: "Lower Bound",
                        borderColor: "#C0C0C0",
                        backgroundColor: '#C0C0C0',
                        fill: false,
                        pointRadius: 0
                     }
                  ]
               },
               options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  plugins: {
                     legend: {
                        position: 'bottom', // Position legend at the bottom
                        labels: {
                           usePointStyle: true,

                        }
                     },
                  },
               }
            }
         );
      })();
   </script>

@endsection
