@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section class="px-5 py-10">
      <div class="flex justify-between mb-5">
         <h2 class="text-primary text-2xl font-bold">Edit Pet</h2>
      </div>

      <div class="flex items-center gap-10">
         <div class="bs-stepper w-full">
            <div class="bs-stepper-header justify-center !mb-10" role="tablist">
               <div class="step" data-target="#pet-basic-detail-part">
                  <button type="button" class="step-trigger flex flex-col" role="tab"
                     aria-controls="pet-basic-detail-part" id="pet-basic-detail-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-paw"></i></span>
                     <span class="bs-stepper-label max-w-24 text-wrap text-center">Pet Information</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#pet-allergy-part">
                  <button type="button" class="step-trigger flex flex-col" role="tab" aria-controls="pet-allergy-part"
                     id="pet-allergy-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i></span>
                     <span class="bs-stepper-label max-w-24 text-wrap text-center">Allergy Information</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#pet-vaccination-part">
                  <button type="button" class="step-trigger flex flex-col" role="tab"
                     aria-controls="pet-vaccination-part" id="pet-vaccination-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-syringe"></i></span>
                     <span class="bs-stepper-label max-w-24 text-wrap text-center">Vaccination Information</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#pet-medication-part">
                  <button type="button" class="step-trigger flex flex-col" role="tab"
                     aria-controls="pet-medication-part" id="pet-medication-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-prescription-bottle-pill"></i></span>
                     <span class="bs-stepper-label max-w-24 text-wrap text-center">Medication Information</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#medical-record-part">
                  <button type="button" class="step-trigger flex flex-col" role="tab"
                     aria-controls="medical-record-part" id="medical-record-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-duotone fa-solid fa-book-medical"></i></span>
                     <span class="bs-stepper-label max-w-24 text-wrap text-center">Medical Record Information</span>
                  </button>
               </div>
            </div>
            <div class="bs-stepper-content">
               <div id="pet-basic-detail-part" class="content" role="tabpanel"
                  aria-labelledby="pet-basic-detail-part-trigger">

                  <form method="POST" action="{{ route('pet-owner.pet.update', $selectedPet->id) }}"
                     class="pet_basic_detail_form" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')

                     <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
                        <div class="relative">
                           <label for="pet_image" class="link">
                              <div
                                 class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                                 <i class="fa-regular fa-images"></i>
                              </div>
                           </label>
                           <img id="pet_image_preview" class="w-36 h-36 rounded-full unselectable"
                              src="{{ asset($selectedPet->attachment->first()?->path) }}" alt="pet image">
                        </div>
                        <input name="pet_image" id="pet_image" type="file" class="hidden" accept=".png, .jpg, .jpeg" />
                     </div>

                     <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-5">
                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Name</span>
                           </div>
                           <input type="text" name="name" value="{{ $selectedPet->name }}"
                              class="input input-bordered w-full form-validation" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Chip Number</span>
                           </div>
                           <input type="text" name="chip_number" value="{{ $selectedPet->chip_number }}"
                              class="input input-bordered w-full form-validation" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Pet Type</span>
                           </div>
                           <div>
                              <input value="{{ $selectedPet->breed->petType->name }}"
                                 class="input input-bordered w-full bg-gray-200" readonly />
                           </div>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Breed</span>
                           </div>
                           <select id="breed_id" name="breed_id"
                              class="select select-2 select-bordered w-full form-control flex-row">
                           </select>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Date of Birth</span>
                           </div>
                           <input type="text" name="birth_date"
                              value="{{ $selectedPet->birth_date?->format('d-m-Y') }}"
                              class="input input-bordered w-full" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Weight</span>
                           </div>
                           <label class="input input-bordered flex items-center gap-2">
                              <input type="text" value="{{ $selectedPet->petWeight->first()?->weight }}"
                                 class="grow weight" />
                              Kg
                           </label>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Sex</span>
                           </div>
                           <select id="gender" class="select select-bordered w-full form-control flex-row"
                              name="gender">
                              <option value="" hidden></option>
                              <option value="m">Male</option>
                              <option value="f">Female</option>
                           </select>
                        </label>
                     </div>
                     <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary btn-padding">
                           Simpan <i class="fa fa-paw"></i>
                        </button>
                     </div>
                  </form>

                  <h2 class="text-lg text-error font-bold mb-1 mt-10">Danger Zone</h2>
                  <div class="w-full flex items-center justify-center p-5 border-error border-2 rounded-xl">
                     <form action="{{ route('pet-owner.pet.destroy', ['pet' => $selectedPet->id]) }}" method="POST"
                        id="deletePetForm">
                        @csrf
                        @method('DELETE')
                        <button id="deletePetButton" class="btn btn-error btn-padding text-white uppercase"
                           type="button">delete pet</button>
                     </form>
                  </div>
               </div>

               <div id="pet-allergy-part" class="content" role="tabpanel" aria-labelledby="pet-allergy-part-trigger">
                  <form class="grid gap-3 mb-12" id="petAllergyForm">
                     <input type="hidden" class="pet_allergy_id" name="id">
                     <input type="hidden" name="pet_id" value="{{ $selectedPet->id }}">

                     <div class="grid lg:grid-cols-3 gap-2">
                        <label class="form-control">
                           <div class="label">
                              <span class="label-text font-semibold">Allergy <span class="text-red-500 ">*</span></span>
                           </div>
                           <input type="text" class="input input-bordered w-full allergy_name" name="name"
                              required />
                        </label>

                        <label class="form-control">
                           <div class="label">
                              <span class="label-text font-semibold">Icon <span class="text-red-500 ">*</span></span>
                           </div>
                           <select class="select_icon select-2" data-placeholder="" name="icon_id">
                              <option value=""></option>
                              @foreach ($icons as $icon)
                                 <option class="text-black" value="{{ $icon->id }}">
                                    {{ $icon->name }}
                                 </option>
                              @endforeach
                           </select>
                        </label>

                        <label class="form-control">
                           <div class="label">
                              <span class="label-text font-semibold">Allergy Category <span
                                    class="text-red-500 ">*</span></span>
                           </div>
                           <select class="select-2" data-placeholder="" name="allergy_category_id">
                              <option value="" hidden></option>
                              @foreach ($allergyCategories as $allergyCategory)
                                 <option class="text-black" value="{{ $allergyCategory->id }}">
                                    {{ $allergyCategory->name }}
                                 </option>
                              @endforeach
                           </select>
                        </label>
                     </div>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Description</span>
                        </div>
                        <textarea type="text" class="textarea textarea-bordered w-full allergy_description" rows="2"
                           name="note"></textarea>
                     </label>

                     <div class="flex justify-end">
                        <button type="submit" class="btn btn-padding btn-primary mt-3 pet_allergy_btn">Add</button>
                     </div>
                  </form>

                  <table class="pet_allergy_list_table row-border dt-left">
                     <thead>
                        <tr>
                           <th class="w-1/12">Icon</th>
                           <th class="w-1/12">Category</th>
                           <th class="w-1/12">Allergy</th>
                           <th class="w-6/12">Description</th>
                           <th class="w-2/12">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>

               <div id="pet-vaccination-part" class="content" role="tabpanel"
                  aria-labelledby="pet-vaccination-part-trigger">
                  <form action="#" class="grid gap-3 mb-12" id="petVaccinationForm">
                     <input type="hidden" name="pet_id" value="{{ $pet->id }}">

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Vaccination <span class="text-red-500 ">*</span></span>
                        </div>

                        <select class="select select-2 select-bordered w-full form-control flex-row vaccination_select"
                           data-placeholder="" name="vaccination_id">
                        </select>
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Veterinarian <span
                                 class="text-red-500 ">*</span></span>
                        </div>
                        <input type="text" class="input input-bordered w-full" name="given_by" />
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Given At <span class="text-red-500 ">*</span></span>
                        </div>
                        <input type="text" class="input input-bordered w-full date-picker" name="given_at"
                           readonly />
                     </label>

                     <div class="flex justify-end">
                        <button type="submit" class="btn btn-padding btn-primary mt-3 pet_vaccination_btn">Add</button>
                     </div>
                  </form>

                  <table class="pet_vaccination_list_table w-full row-border text-left">
                     <thead>
                        <tr>
                           <th class="w-3/12">Vaccination</th>
                           <th class="w-3/12">Veterinarian</th>
                           <th class="w-3/12">Given At</th>
                           <th class="w-3/12">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>

               <div id="pet-medication-part" class="content" role="tabpanel"
                  aria-labelledby="pet-medication-part-trigger">
                  <form action="#" class="grid gap-3 mb-12" id="petMedicationForm">
                     <input type="hidden" name="pet_id" value="{{ $pet->id }}">

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Medication Type <span
                                 class="text-red-500 ">*</span></span>
                        </div>

                        <select class="select select-2 select-bordered w-full form-control flex-row" data-placeholder=""
                           name="medication_type_id" required>
                           <option value="" hidden></option>
                           @foreach ($medicationTypes as $medicationType)
                              <option class="text-black" value="{{ $medicationType->id }}">
                                 {{ $medicationType->name }}
                              </option>
                           @endforeach
                        </select>
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Medication Name <span
                                 class="text-red-500 ">*</span></span>
                        </div>
                        <input type="text" class="input input-bordered w-full" name="medicine_name" required />
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Given At <span class="text-red-500 ">*</span></span>
                        </div>
                        <input type="text" class="input input-bordered w-full date-picker" name="given_at" readonly
                           required />
                     </label>

                     <div class="flex justify-end">
                        <button type="submit" class="btn btn-padding btn-primary mt-3 pet_medication_btn">Add</button>
                     </div>
                  </form>

                  <table class="pet_medication_list_table w-full row-border text-left">
                     <thead>
                        <tr>
                           <th class="w-3/12">Medication Type</th>
                           <th class="w-3/12">Medication Name</th>
                           <th class="w-3/12">Given At</th>
                           <th class="w-3/12">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>

               <div id="medical-record-part" class="content" role="tabpanel"
                  aria-labelledby="medical-record-part-trigger">

                  <table class="pet_medical_list_table w-full row-border text-left">
                     <thead>
                        <tr>
                           <th class="w-2/12">Disease</th>
                           <th class="w-2/12">Medicine</th>
                           <th class="w-5/12">Description</th>
                           <th class="w-2/12">Diagnosed At</th>
                           <th class="w-1/12">Appointment Detail</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\PetOwner\StorePetMedicationRequest', '#petMedicationForm') !!}
   {!! JsValidator::formRequest('App\Http\Requests\PetOwner\StorePetAllergyRequest', '#petAllergyForm') !!}
   {!! JsValidator::formRequest('App\Http\Requests\PetOwner\StorePetVaccinationRequest', '#petVaccinationForm') !!}
   <script>
      const icons = @json($icons);
      const allergyCategories = @json($allergyCategories);

      const el = document.querySelector('[name="birth_date"]');
      new AirDatepicker(el, {
         ...airDatePickerDefaultConfiguration,
         maxDate: new Date(),
      });

      $(function() {
         const pet = @json($selectedPet);

         $('#pet_image').change(function() {
            previewImageWithSelector(
               this,
               '#pet_image_preview',
               "{{ asset('assets/default-pet.jpg') }}")
         });

         const plainDatatableConfiguration = {
            bLengthChange: false,
            autoWidth: false,
         };

         const petAllergyData = pet.pet_allergy.map(function(allergy) {
            return {
               id: allergy.id,
               name: allergy.name,
               note: allergy.note,
               icon: allergy.icon.name,
               allergy_category: allergy.allergy_category.name
            };
         });

         const petVaccinationData = pet.pet_vaccination.map(function(petVac) {
            return {
               id: petVac.id,
               vaccination: petVac.vaccination.name,
               given_by: petVac.given_by,
               given_at: petVac.given_at,
            };
         });

         console.log(pet)

         const petMedicationData = pet.pet_medication.map(function(petMedication) {
            return {
               id: petMedication.id,
               medication_type: petMedication.medication_type.name,
               medication_name: petMedication.medicine_name,
               given_at: petMedication.given_at,
            };
         });

         const petMedicalData = pet.medical_record.map(function(medicalRecord) {
            return {
               disease: medicalRecord.disease_name,
               medicine: medicalRecord.medicine_name,
               description: medicalRecord.description,
               diagnosed_at: new Date(medicalRecord.created_at).toLocaleDateString("en-Us"),
               appointment_id: medicalRecord.appointment_id,
            }
         });

         const petAllergyDatatables = new DataTable('.pet_allergy_list_table', {
            ...plainDatatableConfiguration,
            columns: [{
                  data: 'icon',
                  name: 'icon',
                  type: 'string',
                  render: function(data) {
                     return `<i class="${data}"></i>`;
                  }
               },
               {
                  data: 'allergy_category',
                  name: 'allergy_category'
               },
               {
                  data: 'name',
                  name: 'name'
               },
               {
                  data: 'note',
                  name: 'note'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function() {
                     return `
                     <div class='flex gap-1'>
                        <button class='btn p-2 rounded-full btn-secondary text-white delete_btn'><i class='fa-solid fa-trash'></i></button>
                     </div>
                     `
                  }
               }
            ],
            data: petAllergyData,
            rowId: 'id'
         });

         const petVaccinationDatatables = new DataTable('.pet_vaccination_list_table', {
            ...plainDatatableConfiguration,
            columns: [{
                  data: 'vaccination',
                  name: 'vaccination'
               },
               {
                  data: 'given_by',
                  name: 'given_by'
               },
               {
                  data: 'given_at',
                  name: 'given_at',
                  type: 'string',
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function() {
                     return `
                     <div class='flex gap-1'>
                        <button class='btn p-2 rounded-full btn-secondary text-white delete_btn'><i class='fa-solid fa-trash'></i></button>
                     </div>
                     `
                  }
               }
            ],
            data: petVaccinationData,
            rowId: 'id'
         });


         const petMedicationDatatables = new DataTable('.pet_medication_list_table', {
            ...plainDatatableConfiguration,
            columns: [{
                  data: 'medication_type',
                  name: 'medication_type'
               },
               {
                  data: 'medication_name',
                  name: 'medication_name'
               },
               {
                  data: 'given_at',
                  name: 'given_at',
                  type: 'string',
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function() {
                     return `
                     <div class='flex gap-1'>
                        <button class='btn p-2 rounded-full btn-secondary text-white delete_btn'><i class='fa-solid fa-trash'></i></button>
                     </div>
                     `
                  }
               }
            ],
            data: petMedicationData,
            rowId: 'id'
         });

         new DataTable('.pet_medical_list_table', {
            ...plainDatatableConfiguration,
            columns: [{
                  data: 'disease',
                  name: 'disease'
               },
               {
                  data: 'medicine',
                  name: 'medicine'
               },
               {
                  data: 'description',
                  name: 'description'
               },
               {
                  data: 'diagnosed_at',
                  name: 'diagnosed_at'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function(_, _, row) {
                     const route = "{{ route('pet-owner.appointment.show', ':id') }}";

                     return `
                        <a href="${route.replace(':id',row.appointment_id)}" class='btn p-2 rounded-full btn-secondary text-white'><i class='fa-solid fa-eye'></i></button>

                     `
                  }
               }
            ],
            data: petMedicalData,
            rowId: 'id'
         });

         $('.weight').keydown(function() {
            $(this).attr('name', 'weight');
         });

         $('.select_icon').select2({
            templateResult: function(state) {
               return $(`<span><i class="${state.text} fa-2x"></i></span>`);
            },
            templateSelection: function(state) {
               return $(`<span><i class="${state.text} fa-2x"></i></span>`);
            },
            minimumResultsForSearch: -1
         });

         const getBreedTemplateUrl = "{{ route('master.breed', ':PET_TYPE_ID:') }}";
         const getVaccinationTemplateUrl = "{{ route('master.vaccination', ':PET_TYPE_ID:') }}";

         $('#breed_id').select2({
            placeholder: '',
            ajax: {
               delay: 500,
               cache: true,
               url: getBreedTemplateUrl.replace(':PET_TYPE_ID:', pet.breed.pet_type_id),
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

         $.get({
            url: getVaccinationTemplateUrl.replace(':PET_TYPE_ID:', pet.breed.pet_type_id),
            beforeSend: function() {
               $('.vaccination_select').empty().trigger("change");
            },
            success: function(data) {
               $('.vaccination_select').prepend(new Option('', ''));
               data.map((d) => $('.vaccination_select').append(new Option(d.text, d.id)));
            }
         });

         $('#pet_type_id').val(pet.breed.pet_type_id).trigger('change');
         $("#breed_id").append(`<option value='${pet.breed_id}' selected>${pet.breed.name}</option>`);
         $('#gender').val(pet.gender).trigger('change');

         const stepper = new Stepper($('.bs-stepper')[0], {
            linear: false
         })

         const jumpToStep = "{{ $jumpToStep }}";

         if (jumpToStep) {
            stepper.to(jumpToStep);
         }

         $('.stepper_next').click(function(e) {
            e.preventDefault();
            stepper.next();
         });

         $('.stepper_previous').click(function(e) {
            e.preventDefault();
            stepper.previous();
         });

         bindDeleteMethod(
            '.pet_allergy_list_table',
            petAllergyDatatables,
            "{{ route('pet-owner.pet-allergy.destroy', ':id') }}"
         );

         bindDatatableAddRecordMethod(
            '.pet_allergy_btn',
            petAllergyDatatables,
            "{{ route('pet-owner.pet-allergy.store') }}"
         );

         bindDatatableAddRecordMethod(
            '.pet_medication_btn',
            petMedicationDatatables,
            "{{ route('pet-owner.pet-medication.store') }}"
         );

         bindDeleteMethod(
            '.pet_medication_list_table',
            petMedicationDatatables,
            "{{ route('pet-owner.pet-medication.destroy', ':id') }}"
         );

         bindDatatableAddRecordMethod(
            '.pet_vaccination_btn',
            petVaccinationDatatables,
            "{{ route('pet-owner.pet-vaccination.store') }}"
         );

         bindDeleteMethod(
            '.pet_vaccination_list_table',
            petVaccinationDatatables,
            "{{ route('pet-owner.pet-vaccination.destroy', ':id') }}"
         );
      });

      document.getElementById('deletePetButton').addEventListener('click', function() {
         swal({
            title: "Are you sure?",
            text: "Type 'DELETE' to confirm.",
            content: {
               element: "input",
               attributes: {
                  placeholder: "Type DELETE here...",
                  type: "text",
               },
            },
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
         }).then((value) => {
            if (value === "DELETE") {
               document.getElementById('deletePetForm').submit();
            } else if (value) {
               swal("Error", "You must type DELETE to confirm.", "error");
            }
         });
      });

      function resetForm($formElement) {
         $formElement.trigger('reset');
         $formElement.find('.select-2').val('').trigger('change');
      }

      function bindDeleteMethod(tableSelector, datatable, deleteUrl) {
         $(tableSelector + ' tbody').on('click', '.delete_btn', function() {
            const row = datatable.row($(this).parents('tr'));
            const data = row.data();

            $.ajax({
               type: 'DELETE',
               url: deleteUrl.replace(':id', data.id),
               success: function() {
                  row.remove().draw();

                  const $formElement = $(e.currentTarget).closest('form');
                  resetForm($formElement);
               }
            });
         });
      }

      function bindDatatableAddRecordMethod(formBtnSelector, datatable, postUrl) {
         $(document).on('click', formBtnSelector, function(e) {
            e.preventDefault();

            const $formElement = $(e.currentTarget).closest('form');
            const formPayload = $formElement.serialize();

            if (!$formElement.valid()) {
               return;
            }

            $.post({
               url: postUrl,
               data: formPayload,
               beforeSend: function() {
                  $.LoadingOverlay("show");
               },
               success: function(response) {
                  swal('success', 'Data Successfully Added', 'success');
                  resetForm($formElement);

                  datatable.row.add(response).draw();
               },
               error: function() {
                  swal('error', 'Something went wrong', 'error');
               },
               complete: function() {
                  $.LoadingOverlay("hide");
               }
            });
         });
      }
   </script>
@endsection
