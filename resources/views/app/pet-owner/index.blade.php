@extends('layouts.pet-owner.layout')

@section('title', 'Home')

@section('content')
   <div class="h-full">
      <div class="flex h-full gap-5 justify-start items-start">
         <section class="flex justify-stretch mb-9 bg-white h-full">
            <div class="card">
               <div class="card-body rounded shadow-2xl pet_detail_container">
                  {{-- <div class="hidden container_pet_not_found">
                     <div class="flex flex-col items-center justify-center w-full">
                        <img class="text-primary" src="{{ asset('assets/crying-dog-icon.svg') }}" alt="">
                        <span class="mb-2 text-lg">Tidak terdapat data hewan</span>
                        <a href="{{ route('pet-owner.pet.create') }}" class="btn btn-primary btn-padding"><i
                              class="fa fa-solid fa-plus"></i> Tambahkan Hewan</a>
                     </div>
                  </div> --}}

                  <div class="container_pet_detail w-full flex flex-col items-center">
                     <img class="rounded-full w-36 h-36 pet_image border border-gray-400 mb-5"
                        src="{{ asset($pet?->thumbnail_image) }}" alt="">
                     <div>
                        <h1 class="text-3xl font-bold pet_name text-center">{{ $pet?->name }}</h1>
                        <h2 class="pet_breed text-2xl text-gray-400 text-center">{{ $pet?->breed->name }}</h2>
                     </div>

                     <div class="mt-8 flex flex-row justify-center gap-3 text-lg">
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-gray-900 font-bold">{{ $pet?->age }}</span>
                           <span class="text-primary font-bold">Umur</span>
                        </div>
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-gray-900 font-bold pet_weight">{{ $pet?->weight }}</span>
                           <span class="text-primary font-bold">Berat</span>
                        </div>
                        <div class="w-28 h-16 flex flex-col items-center justify-center bg-base-100 rounded shadow">
                           <span class="text-gray-900 font-bold pet_gender">{{ $pet?->gender }}</span>
                           <span class="text-primary font-bold">Sex</span>
                        </div>
                     </div>

                     <div class="w-full mt-12">
                        <div class="flex justify-between items-center mb-5 w-full">
                           <span class="font-bold">Janji Temu Terahkir</span>
                           <a class="text-primary font-bold border-b border-transparent hover:border-primary"
                              href="#">
                              <span class="me-1 text-sm">Lihat Semua</span>
                              <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
                           </a>
                        </div>

                        <div class="grid grid-rows-3">
                           @forelse ($pet?->appointment->take(3) ?? [] as $appointment)
                              <div class="border-b-2 flex py-4 px-2 gap-6 items-center justify-evenly">
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
                                    {{ $appointment->created_at }}
                                 </div>
                              </div>
                           @empty
                           @endforelse
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <div class="w-full pe-10 pt-5">
            <div>
               <div class="mb-5 w-full">
                  <span class="font-bold text-xl">Kondisi Kesehatan</span>
               </div>
               <div class="grid grid-cols-2 grid-rows-2 gap-5">
                  <section>
                     <div class="card h-full">
                        <div class="card-body p-4 bg-white bg-opacity-85 shadow rounded-xl">
                           <div class="flex justify-between items-center mb-2 w-full">
                              <div class="text-gray-400 border-gray-400 hover:border-b">
                                 <span class="text-sm me-1 font-semibold">Alergi</span>
                                 <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
                              </div>
                              <div>
                                 <span class="font-bold text-xl">{{ $pet?->petAllergy->count() ?? 0 }}</span>
                              </div>
                           </div>
                           <div class="grid grid-rows-3 gap-2">
                              @forelse ($pet?->petAllergy->take(3) ?? [] as $petAllergy)
                                 <div class="card">
                                    <div class="card-body flex-row p-0 gap-4 items-center justify-start">
                                       <div
                                          class="bg-gray-200 rounded-full text-gray-400 flex items-center justify-center w-10 h-10">
                                          <i class="fa-solid fa-egg"></i>
                                       </div>

                                       <div class="flex flex-col gap-2">
                                          <div class="text-gray-900 font-bold">
                                             {{ $petAllergy->name }}
                                          </div>
                                          <div class="flex items-center gap-2">
                                             <span class="text-gray-400">{{ $petAllergy->note }}</span>
                                          </div>
                                       </div>
                                       <div class="ms-auto {{ $petAllergy->allergyType->color_class }}">
                                          {{ $pettAllergy->allergyType->name }}
                                       </div>
                                    </div>
                                 </div>
                              @empty
                              @endforelse
                           </div>
                        </div>
                     </div>
                  </section>

                  <section>
                     <div class="card h-full">
                        <div class="card-body p-4 bg-white bg-opacity-85 shadow rounded-xl">
                           <div class="flex justify-between items-center mb-2 w-full">
                              <div class="text-gray-400 border-gray-400 hover:border-b">
                                 <span class="text-sm me-1 font-semibold">Riwayat Penyakit</span>
                                 <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
                              </div>
                              <div>
                                 <span class="font-bold text-xl">{{ $pet?->medicalRecord->count() ?? 0 }}</span>
                              </div>
                           </div>
                           <div class="grid grid-rows-3 gap-2 h-full">
                              @forelse ($pet?->medicalRecord->take(3) ?? [] as $medicalRecord)
                                 <div class="card">
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
                              @endforelse
                           </div>
                        </div>
                     </div>
                  </section>

                  <section>
                     <div class="card h-full">
                        <div class="card-body p-4 bg-white bg-opacity-85 shadow rounded-xl">
                           <div class="flex justify-between items-center mb-2 w-full">
                              <div class="text-gray-400 border-gray-400 hover:border-b">
                                 <span class="text-sm me-1 font-semibold">Vaksinasi</span>
                                 <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
                              </div>
                              <div>
                                 <span class="font-bold text-xl">{{ $pet?->petVaccination->count() ?? 0 }}</span>
                              </div>
                           </div>
                           <div class="grid grid-rows-3 gap-2 h-full">
                              @forelse ($pet?->petVaccination->take(3) ?? [] as $petVaccination)
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
                              @endforelse
                           </div>
                        </div>
                     </div>
                  </section>

                  <section>
                     <div class="card h-full">
                        <div class="card-body p-4 bg-white bg-opacity-85 shadow rounded-xl">
                           <div class="flex justify-between items-center mb-2 w-full">
                              <div class="text-gray-400">
                                 <span class="text-sm me-1 font-semibold">Pertumbuhan Berat</span>
                              </div>
                           </div>

                           <div style="width: 100%;"><canvas id="acquisitions"></canvas></div>
                        </div>
                     </div>

                  </section>
               </div>
            </div>

            <section class="pt-5">
               <div class="flex justify-between items-center mb-5 w-full">
                  <span class="font-bold text-xl">Janji Mendatang</span>
                  <a class="text-primary font-bold border-primary hover:border-b" href="#">
                     <span class="me-1 text-sm">Lihat Semua</span>
                     <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
                  </a>
               </div>

               <div class="grid grid-rows-3 gap-5">
                  <div class="card">
                     <div
                        class="card-body bg-white bg-opacity-85 shadow rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-75">
                        <div class="px-8 py-4 flex flex-col font-bold items-center justify-center border-r-2 h-full">
                           <span class="text-primary">Jan</span>
                           <span>27</span>
                        </div>
                        <div class="py-4 flex flex-col gap-2">
                           <div class="text-gray-900 font-semibold">
                              Joergen
                           </div>
                           <div class="flex items-center gap-2">
                              <i class="fa-solid fa-clock text-gray-400"></i>
                              <span class="text-gray-900">Jan, 20, 09.00 - 10.00</span>
                           </div>
                        </div>
                        <div class="ms-auto pe-4 hidden group-hover:block">
                           <i class="fa-solid fa-arrow-right text-primary text-lg"></i>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div
                        class="card-body bg-white bg-opacity-85 shadow rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-75">
                        <div class="px-8 py-4 flex flex-col font-bold items-center justify-center border-r-2 h-full">
                           <span class="text-primary">Jan</span>
                           <span>27</span>
                        </div>
                        <div class="py-4 flex flex-col gap-2">
                           <div class="text-gray-900 font-semibold">
                              Joergen
                           </div>
                           <div class="flex items-center gap-2">
                              <i class="fa-solid fa-clock text-gray-400"></i>
                              <span class="text-gray-900">Jan, 20, 09.00 - 10.00</span>
                           </div>
                        </div>
                        <div class="ms-auto pe-4 hidden group-hover:block">
                           <i class="fa-solid fa-arrow-right text-primary text-lg"></i>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      (async function() {
         new Chart(
            document.getElementById('acquisitions'), {
               type: 'line',
               data: {
                  labels: [1,2,3,4,5,6],
                  datasets: [{
                        data: [6, 6, 6, 6.5, 7, 8],
                        label: "Atas",
                        borderColor: "#eee",
                        fill: false
                     },
                     {
                        data: [2, 2, 4, 5, 6, 7],
                        label: "Berat",
                        borderColor: "#3cba9f",
                        fill: false
                     },
                     {
                        data: [0.5, 1, 1.5, 2, 2, 3],
                        label: "bawah",
                        borderColor: "#eee",
                        fill: false
                     }
                  ]
               },
               options: {
                  title: {
                     display: true,
                     text: 'Pertumbuhan Berat'
                  }
               }
            }
         );
      })();

      $(document).ready(function() {



      });

      // $('.pet_select_item').click(function() {
      //    const petId = $(this).attr('pet-id');

      //    updatePetViewData(pets, petId);
      // });

      // function initPetDetailView(pets) {
      //    if (pets.length === 0) {
      //       $('.container_pet_detail').hide();
      //       $('.container_pet_not_found').show();
      //       return;
      //    }

      //    updatePetViewData(pets, pets[0].id);
      // }

      // function updatePetViewData(pets, selectedPetId) {
      //    const pet = pets.find(pet => pet.id == selectedPetId);
      //    const petEditTemplateRoute = "{{ route('pet-owner.pet.edit', ':ID:') }}";

      //    $('.pet_select_list li img').removeClass('border-4 border-primary');
      //    $(`[pet-id=${selectedPetId}] img`).addClass('border-4 border-primary');

      //    const petTextPayloadWithClassName = {
      //       'pet_name': pet.name,
      //       'pet_weight': pet.weight,
      //       'pet_breed': pet.breed.name,
      //       'pet_birth_date': pet.birth_date,
      //       'pet_gender': pet.gender
      //    };

      //    $.each(petTextPayloadWithClassName, function(className, value) {
      //       $('.' + className).text(value);
      //    });

      //    $('.pet_image').attr('src', pet.thumbnail_image);
      //    $('.pet_edit_button').attr('href', petEditTemplateRoute.replace(':ID:', pet.id))
      // }
   </script>

@endsection
