@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section class="p-4 pt-12 lg:p-14 w-full h-full">

      <div class="bs-stepper w-full h-full flex flex-col relative">
         <div class="bs-stepper-content flex-1 flex flex-col">
            <!-- your steps content here -->
            <div id="pet-name-part" class="content h-full" role="tabpanel" aria-labelledby="pet-name-part-trigger">
               <div class="h-full flex flex-col justify-between items-center">
                  <div class="lg:w-1/2">
                     <div class="text-center">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">
                           Siapa Nama hewan Peliharaan Anda?
                        </h2>
                     </div>
                     <input type="text" name="name" placeholder="Masukan nama peliharaan"
                        class="p-3 border-grayZ bg-transparent border-b w-full outline-none pet_name text-2xl" />
                  </div>
                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_next">Lanjutkan</button>
                  </div>
               </div>
            </div>

            <div id="pet-type-part" class="content h-full" role="tabpanel" aria-labelledby="pet-type-part-trigger">
               <div class="h-full flex flex-col justify-between items-center gap-11">
                  <div class="lg:w-1/2">
                     <div class="text-center">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">Apa jenis hewan peliharaan anda?
                        </h2>
                     </div>
                     <div class="grid grid-cols-2 gap-4 pet_type_select">
                        @foreach ($petTypes as $petType)
                           <input class="hidden pet_type_id" type="radio" name="pet_type_id" value="{{ $petType->id }}"
                              id="pet_type_{{ $petType->id }}">
                           <label for="pet_type_{{ $petType->id }}">
                              <div
                                 class="bg-primary text-white bg-opacity-75 border-orange-800 !h-32 flex flex-col gap-4 items-center justify-center cursor-pointer rounded-xl item">
                                 <i class="{{ $petType->icon->name }} fa-3x"></i>
                                 <span class="text-xl font-bold">{{ ucwords($petType->name) }}</span>
                              </div>
                           </label>
                        @endforeach
                     </div>
                  </div>

                  <div class="absolute top-0 left-0">
                     <button type="submit" class="btn btn-primary py-3 px-4 stepper_previous">
                        <i class="fa-light fa-chevron-left"></i>
                     </button>
                  </div>

                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_next">Lanjutkan</button>
                  </div>
               </div>
            </div>

            <div id="pet-breed-part" class="content h-full" role="tabpanel" aria-labelledby="pet-breed-part-trigger">
               <div class="h-full flex flex-col justify-between items-center">
                  <div class="lg:w-1/2">
                     <div class="text-center">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">
                           Sebutkan jenis <span class="pet_name_display"></span> ?
                        </h2>
                     </div>

                     <select id="breed_id" name="breed_id"
                        class="select select-2 select-bordered bg-transparent w-full form-control flex-row text-2xl"
                        data-placeholder="Cari jenis">
                        <option value=""></option>
                     </select>
                  </div>

                  <div class="absolute top-0 left-0">
                     <button type="submit" class="btn btn-primary py-3 px-4 stepper_previous">
                        <i class="fa-light fa-chevron-left"></i>
                     </button>
                  </div>

                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_next">Lanjutkan</button>
                  </div>
               </div>
            </div>

            <div id="pet-more-information-part" class="content h-full" role="tabpanel"
               aria-labelledby="pet-more-information-part-trigger">
               <div class="h-full flex flex-col justify-between items-center">
                  <div class="lg:w-1/2">
                     <div class="text-center">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">
                           Beri tahu kami lebih mengenai <span class="pet_name_display"></span> ?
                        </h2>
                     </div>

                     <div class="grid grid-cols-2 gap-5">
                        <div class="form-control w-full">
                           <input type="text" name="weight" placeholder="Masukan berat hewan"
                              class="input input-bordered w-full bg-transparent hover:outline-none focus-visible:outline-none" />
                           <div class="label">
                              <span class="ms-auto label-text-alt">Dalam bentuk Kg</span>
                           </div>
                        </div>
                        <div class="form-control w-full">
                           <input type="text" name="birth_date" placeholder="Masukan tanggal lahir"
                              class="input input-bordered w-full bg-transparent hover:outline-none focus-visible:outline-none date-picker"
                              readonly />
                        </div>

                        <div class="flex flex-col items-center gap-4 col-span-2">
                           <label class="text-2xl" for="">Jenis Kelamin</label>
                           <div class="d-flex fa-5x text-gray-400">
                              <input class="hidden" type="radio" name="gender" value="m" id="male">
                              <input class="hidden" type="radio" name="gender" value="f" id="female">
                              <label class="gender" for="male">
                                 <i class="fa-solid fa-mars"></i>
                              </label>
                              <label class="gender" for="female">
                                 <i class="fa-solid fa-venus"></i>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="absolute top-0 left-0">
                     <button type="submit" class="btn btn-primary py-3 px-4 stepper_previous">
                        <i class="fa-light fa-chevron-left"></i>
                     </button>
                  </div>

                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_next">Lanjutkan</button>
                  </div>
               </div>
            </div>

            <div id="pet-image-part" class="content h-full" role="tabpanel" aria-labelledby="pet-image-part-trigger">
               <div class="h-full flex flex-col justify-between items-center">
                  <div class="lg:w-1/2">
                     <div class="text-center">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">
                           Tambahkan Gambar
                        </h2>
                     </div>

                     <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
                        <div class="relative">
                           <label for="pet_image" class="link">
                              <div
                                 class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                                 <i class="fa-regular fa-images"></i>
                              </div>
                           </label>
                           <img id="pet_image_preview" class="w-40 h-40 rounded unselectable"
                              src="{{ asset('assets/default-pet.jpg') }}" alt="pet image">
                        </div>
                        <input name="pet_image" id="pet_image" type="file" class="hidden"
                           accept=".png, .jpg, .jpeg" />
                     </div>
                  </div>

                  <div class="absolute top-0 left-0">
                     <button type="submit" class="btn btn-primary py-3 px-4 stepper_previous">
                        <i class="fa-light fa-chevron-left"></i>
                     </button>
                  </div>

                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_next">Lanjutkan</button>
                  </div>
               </div>
            </div>

            <div id="pet-allergy-part" class="content h-full" role="tabpanel"
               aria-labelledby="pet-allergy-part-trigger">
               <div class="h-full flex flex-col justify-between items-center gap-11">
                  <div class="lg:w-1/2">
                     <div class="text-center mb-5">
                        <h2 class="text-gray-700 text-3xl font-bold mb-10">Apakah Hewan Anda Memiliki Alergi?
                        </h2>

                        <div
                           class="border border-gray-400 p-4 rounded-xl flex items-center justify-center gap-5 w-full mx-auto">
                           <div class="tooltip tooltip-bottom tooltip-info" data-tip="click to change severity">
                              <button class="text-primary"><i class="fa-light fa-circle-info text-lg"></i></button>
                           </div>
                           <h3 class="font-bold">
                              Allergy Severity
                           </h3>
                           <div class="flex gap-2 items-center">
                              <div class="w-3 h-3 rounded-full bg-secondary"></div>
                              <span class="font-bold">Mild</span>
                           </div>
                           <div class="flex gap-2 items-center">
                              <div class="w-3 h-3 rounded-full bg-accent"></div>
                              <span class="font-bold">Medium</span>
                           </div>
                           <div class="flex gap-2 items-center">
                              <div class="w-3 h-3 rounded-full bg-red-400"></div>
                              <span class="font-bold">Severe</span>
                           </div>
                        </div>
                     </div>
                     <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pet_allergy_select">
                        @foreach ($allergyTemplate as $allergy)
                           <div
                              class="item border border-primary text-primary bg-opacity-85 cursor-pointer rounded-xl p-5 pet_allergy"
                              id="{{ $allergy['name'] }}">
                              <label class="flex flex-col gap-4 items-center justify-center pointer-events-none"
                                 for="{{ $allergy['name'] }}">
                                 <i class="{{ $allergy['icon'] }} fa-3x"></i>
                                 <span class="text-xl font-bold">{{ $allergy['name'] }}</span>
                              </label>
                           </div>
                        @endforeach
                     </div>
                  </div>

                  <div class="absolute top-0 left-0">
                     <button type="submit" class="btn btn-primary py-3 px-4 stepper_previous">
                        <i class="fa-light fa-chevron-left"></i>
                     </button>
                  </div>

                  <div class="text-end ms-auto">
                     <button class="btn btn-primary btn-padding stepper_finish">Selesaikan</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="bs-stepper-header justify-center mb-6" role="tablist">
            <div class="step" data-target="#pet-name-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-name-part"
                  id="pet-name-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
            <div class="step" data-target="#pet-type-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-type-part"
                  id="pet-type-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
            <div class="step" data-target="#pet-breed-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-breed-part"
                  id="pet-breed-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
            <div class="step" data-target="#pet-more-information-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-more-information-part"
                  id="pet-more-information-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
            <div class="step" data-target="#pet-image-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-image-part"
                  id="pet-image-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
            <div class="step" data-target="#pet-allergy-part">
               <button type="button" class="step-trigger" role="tab" aria-controls="pet-allergy-part"
                  id="pet-allergy-part-trigger">
                  <span class="bs-stepper-circle !w-4 !h-4 !rounded-full"></span>
               </button>
            </div>
         </div>
      </div>
   </section>
@endsection

@section('js-footer')
   <script>
      $(function() {
         const defaultPetAllergy = @json($allergyTemplate);

         $('#pet_image').change(function() {
            previewImageWithSelector(
               this,
               '#pet_image_preview',
               "{{ asset('assets/default-pet.jpg') }}")
         });

         $('.gender').click(function(e) {
            $('.gender').removeClass('text-primary');

            $(this).addClass('text-primary');
         });

         $('.pet_type_select .item').click(function() {
            $('.pet_type_select .border-2').removeClass('border-2 shadow-xl');
            $(this).addClass('border-2 shadow-xl');
         });

         $('.pet_name').change(function() {
            $('.pet_name_display').text($(this).val())
         });

         console.log(defaultPetAllergy)

         $('.pet_allergy_select .item').click(function() {
            const mildColor = 'bg-secondary';
            const mediumColor = 'bg-accent';
            const severeColor = 'bg-red-400';

            const isSelected = $(this).hasClass('selected');
            const hasMildColor = $(this).hasClass(mildColor);
            const hasMediumColor = $(this).hasClass(mediumColor);

            const selectedValue = $(this).attr('id');
            const objPetAllergy = defaultPetAllergy.find(o => o.name === selectedValue);

            $(this).attr('class', function(i, c) {
               return c.replace(/(^|\s)bg-\S+/g, '');
            });

            if (!isSelected) {
               $(this).addClass(`${mildColor} text-white selected`);
               objPetAllergy.allergy_category_id = 1;
            } else if (hasMildColor) {
               $(this).addClass(mediumColor);
               objPetAllergy.allergy_category_id = 2;
            } else if (hasMediumColor) {
               $(this).addClass(severeColor);
               objPetAllergy.allergy_category_id = 3;
            } else {
               $(this).removeClass('text-white selected').addClass('text-primary');
               objPetAllergy.allergy_category_id = null;
            }
         });

         $('.pet_type_id').change(function() {
            const getBreedTemplateUrl = "{{ route('master.breed', ':PET_TYPE_ID:') }}";

            $('#breed_id').select2({
               placeholder: '',
               ajax: {
                  delay: 500,
                  cache: true,
                  url: getBreedTemplateUrl.replace(':PET_TYPE_ID:', $(this).val()),
                  data: function(params) {
                     return {
                        q: params.term,
                        page: params.page || 1,
                     };
                  },
                  processResults: function(res, params) {
                     params.page = params.page || 1;

                     const map = res.result.map((itm) => {
                        return {
                           id: itm.id,
                           text: itm.text,
                        }
                     });

                     const results = map || [];

                     return {
                        results: results,
                        pagination: {
                           more: results.length >= 10,
                        },
                     };
                  },
               }
            });
         });

         const stepper = new Stepper($('.bs-stepper')[0], {
            linear: false
         });

         $('.stepper_next').click(function(e) {
            e.preventDefault();
            stepper.next();
         });

         $('.stepper_previous').click(function(e) {
            e.preventDefault();
            stepper.previous();
         });

         function getSelectedValues(selector) {
            const values = [];
            $(`${selector}.selected`).each(function() {
               values.push($(this).attr('id'));
            });
            return values;
         }

         $('.stepper_finish').click(function(e) {
            e.preventDefault();

            $(this).attr('disabled', true);

            const petAllergy = getSelectedValues('.pet_allergy');

            const petAllergyIds = defaultPetAllergy.filter(item => petAllergy.includes(item.name));
            const name = $('[name="name"]').val();
            const breedId = $('[name="breed_id"]').val();
            const gender = $('[name="gender"]').val();
            const weight = $('[name="weight"]').val();
            const chipNumber = $('[name="chip_number"]').val();
            const birthDate = $('[name="birth_date"]').val();
            const petImage = $('[name="pet_image"]')[0].files[0];

            const formData = new FormData();

            formData.append('name', name);
            formData.append('breed_id', breedId);
            formData.append('gender', gender);
            formData.append('weight', weight);
            formData.append('chip_number', chipNumber);
            formData.append('birth_date', birthDate);
            formData.append('pet_image', petImage);
            formData.append('pet_allergy_ids', JSON.stringify(petAllergyIds));

            $.post({
               url: "{{ route('pet-owner.pet.store') }}",
               data: formData,
               processData: false,
               contentType: false,
               beforeSend: function() {
                  $.LoadingOverlay("show");
               },
               success: function() {
                  const index = "{{ route('pet-owner.index') }}";

                  window.location.href = index;
               },
               error: function() {
                  swal('error', 'Terjadi Kesalahan', 'error');
                  $.LoadingOverlay("hide")

                  $('.stepper_finish').attr('disabled', false);
               }
            });
         })
      });
   </script>

   {!! JsValidator::formRequest(
       'App\Http\Requests\PetOwner\StorePetRequest',
       Crypt::encrypt([
           'selector' => '.pet_basic_detail_form',
           'ignore' => '',
       ]),
   ) !!}
@endsection
