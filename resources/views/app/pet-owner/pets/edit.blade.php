@extends('layouts.pet-owner.layout')

@section('title', 'Pet')

@section('content')
   <section>
      <div class="flex justify-between">
         <h2 class="text-primary text-2xl font-bold">Tambahkan Hewan Peliharaan</h2>
      </div>

      <div class="flex items-center gap-10 bg-base-100 shadow-2xl p-9">
         <div class="bs-stepper w-full">
            <div class="bs-stepper-header" role="tablist">
               <!-- your steps here -->
               <div class="step" data-target="#pet-basic-detail-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="pet-basic-detail-part"
                     id="pet-basic-detail-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-paw"></i></span>
                     <span class="bs-stepper-label">Informasi Hewan</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#pet-allergy-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="pet-allergy-part"
                     id="pet-allergy-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i></span>
                     <span class="bs-stepper-label">Alergi</span>
                  </button>
               </div>
               <div class="line"></div>
               <div class="step" data-target="#pet-vaccination-part">
                  <button type="button" class="step-trigger" role="tab" aria-controls="pet-vaccination-part"
                     id="pet-vaccination-part-trigger">
                     <span class="bs-stepper-circle"><i class="fa-solid fa-syringe"></i></span>
                     <span class="bs-stepper-label">Riwayat Vaksinasi</span>
                  </button>
               </div>
            </div>
            <div class="bs-stepper-content">
               <!-- your steps content here -->
               <div id="pet-basic-detail-part" class="content" role="tabpanel"
                  aria-labelledby="pet-basic-detail-part-trigger">

                  <form action="#" class="pet_basic_detail_form" enctype="multipart/form-data">
                     <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
                        <div class="relative">
                           <label for="pet_image" class="link">
                              <div
                                 class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                                 <i class="fa-regular fa-images"></i>
                              </div>
                           </label>
                           <img id="pet_image_preview" class="w-36 h-36 rounded-full unselectable"
                              src="{{ asset($pet->attachment->first()?->path) }}" alt="pet image">
                        </div>
                        <input name="pet_image" id="pet_image" type="file" class="hidden" accept=".png, .jpg, .jpeg" />
                     </div>

                     <div class="grid grid-cols-3 gap-3 mb-5">
                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Nama</span>
                           </div>
                           <input type="text" name="name" value="{{ $pet->name }}"
                              class="input input-bordered w-full form-validation" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Nomor Chip</span>
                           </div>
                           <input type="text" name="chip_number" value="{{ $pet->chip_number }}"
                              class="input input-bordered w-full form-validation" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Tipe</span>
                           </div>
                           <div>
                              <select id="pet_type_id" name="pet_type_id"
                                 class="select select-2 select-bordered w-full form-control flex-row">
                                 <option value="" hidden></option>
                                 @foreach ($petTypes as $petType)
                                    <option value="{{ $petType->id }}">{{ $petType->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Jenis</span>
                           </div>
                           <select id="breed_id" name="breed_id"
                              class="select select-2 select-bordered w-full form-control flex-row">
                              <option value="" hidden></option>
                           </select>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Tanggal Lahir</span>
                           </div>
                           <input type="date" name="birth_date" value="{{ $pet->birth_date }}"
                              class="input input-bordered w-full form-validation" />
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Berat</span>
                           </div>
                           <label class="input input-bordered flex items-center gap-2">
                              <input type="text" name="weight" value="{{ $pet->weight }}" class="grow" />
                              Kg
                           </label>
                        </label>

                        <label class="form-control w-full">
                           <div class="label">
                              <span class="label-text font-semibold">Jenis Kelamin</span>
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
                        <button type="submit" class="btn btn-primary btn-padding stepper_next">Lanjutkan <i
                              class="fa fa-paw"></i></button>
                     </div>
                  </form>
               </div>
               <div id="pet-allergy-part" class="content" role="tabpanel" aria-labelledby="pet-allergy-part-trigger">
                  <form class="grid gap-3 mb-12">
                     <input type="hidden" class="row_index">

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Alergi</span>
                        </div>
                        <input type="text" class="input input-bordered w-full allergy_name" />
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Deskripsi</span>
                        </div>
                        <input type="text" class="input input-bordered w-full allergy_description" />
                     </label>

                     <div class="flex justify-end">
                        <button type="submit"
                           class="btn btn-padding btn-primary mt-3 pet_allergy_btn">Tambahkan</button>
                     </div>
                  </form>

                  <table class="pet_allergy_list_table row-border">
                     <thead>
                        <tr>
                           <th class="w-3/12">Alergi</th>
                           <th>Deskripsi</th>
                           <th class="w-2/12">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>

                  <div class="flex justify-end gap-3 mt-5">
                     <button type="submit" class="btn btn-primary btn-outline btn-padding stepper_previous"><i
                           class="fa fa-arrow-left"></i> Sebelumnya</button>
                     <button type="submit" class="btn btn-primary btn-padding stepper_next">Lanjutkan <i
                           class="fa fa-paw"></i></button>
                  </div>
               </div>
               <div id="pet-vaccination-part" class="content" role="tabpanel"
                  aria-labelledby="pet-vaccination-part-trigger">
                  <form action="#" class="grid gap-3 mb-12">
                     <input type="hidden" class="row_index">

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Nama Vaksinasi</span>
                        </div>

                        <select class="select select-bordered w-full form-control flex-row vaccination_name">
                        </select>
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Nama Dokter</span>
                        </div>
                        <input type="text" class="input input-bordered w-full vaccination_doctor_name" />
                     </label>

                     <label class="form-control w-full">
                        <div class="label">
                           <span class="label-text font-semibold">Diberikan Pada</span>
                        </div>
                        <input type="date" class="input input-bordered w-full vaccination_given_at" />
                     </label>

                     <div class="flex justify-end">
                        <button type="submit"
                           class="btn btn-padding btn-primary mt-3 pet_vaccination_btn">Tambahkan</button>
                     </div>
                  </form>

                  <table class="pet_vaccination_list_table w-full row-border text-left">
                     <thead>
                        <tr>
                           <th class="w-3/12">Nama Vaksin</th>
                           <th class="w-3/12">Nama Dokter</th>
                           <th class="w-3/12">Diberikan Pada</th>
                           <th class="w-3/12">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>

                  <div class="flex justify-end gap-3 mt-5">
                     <button type="submit" class="btn btn-primary btn-outline btn-padding stepper_previous"><i
                           class="fa fa-arrow-left"></i> Sebelumnya</button>
                     <button type="submit" class="btn btn-primary btn-padding stepper_finish">Selesaikan <i
                           class="fa fa-paw"></i></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection

@section('js-footer')
   <script>
      $(function() {
         const pet = @json($pet);

         $('#pet_image').change(function() {
            previewImageWithSelector(
               this,
               '#pet_image_preview',
               "{{ asset('assets/default-pet.jpg') }}")
         });

         const plainDatatableConfiguration = {
            bLengthChange: false,
            autoWidth: false,
            searching: false,
            paging: false,
            info: false
         };

         const petAllergyDatatables = $('.pet_allergy_list_table').DataTable(plainDatatableConfiguration);
         const petMedicalRecordDatatables = $('.pet_medical_record_list_table').DataTable(
            plainDatatableConfiguration);
         const petVaccinationDatatables = $('.pet_vaccination_list_table').DataTable(plainDatatableConfiguration);

         $('#pet_type_id').change(function() {
            const getBreedTemplateUrl = "{{ route('master.breed', ':PET_TYPE_ID:') }}";
            const getVaccinationTemplateUrl = "{{ route('master.vaccination', ':PET_TYPE_ID:') }}";

            $.ajax({
               method: 'get',
               url: getBreedTemplateUrl.replace(':PET_TYPE_ID:', $(this).val()),
               beforeSend: function() {
                  $('#breed_id').empty().trigger("change");
               },
               success: function(data) {
                  data.map((d) => $('#breed_id').append(new Option(d.text, d.id, pet.breed_id == d.id,
                     pet.breed_id == d.id)));
               }
            });

            $.ajax({
               method: 'get',
               url: getVaccinationTemplateUrl.replace(':PET_TYPE_ID:', $(this).val()),
               beforeSend: function() {
                  $('.vaccination_name').empty().trigger("change");
               },
               success: function(data) {
                  $('.vaccination_name').prepend(new Option('', ''));
                  data.map((d) => $('.vaccination_name').append(new Option(d.text, d.text)));
               }
            });
         });

         const stepper = new Stepper($('.bs-stepper')[0], {
            linear: false
         })

         $('.stepper_next').click(function(e) {
            e.preventDefault();
            stepper.next();
         });

         $('.stepper_previous').click(function(e) {
            e.preventDefault();
            stepper.previous();
         });

         $('.stepper_finish').click(function(e) {
            e.preventDefault();

            const data = new FormData($('.pet_basic_detail_form')[0]);

            const deselectAction = row => row.slice(0, -1);

            data.append('pet_allergy',
               JSON.stringify(petAllergyDatatables.rows().data().toArray().map(deselectAction))
            );

            data.append('pet_vaccination',
               JSON.stringify(petVaccinationDatatables.rows().data().toArray().map(deselectAction))
            );

            data.append('pet_medical',
               JSON.stringify(petMedicalRecordDatatables.rows().data().toArray().map(deselectAction))
            );

            $.post({
               url: "{{ route('pet-owner.pet.store') }}",
               data,
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
                  swal('error', 'Terjadi Kesalahan');
               }
            });
         })

         bindDeleteMethod(
            '.pet_allergy_list_table',
            petAllergyDatatables,
            ['.allergy_name, .allergy_description, .row_index']
         );

         bindEditMethod(
            '.pet_allergy_list_table',
            petAllergyDatatables,
            ['.allergy_name', '.allergy_description']
         );

         bindDatatableAddRecordMethod(
            '.pet_allergy_btn',
            petAllergyDatatables,
            ['.allergy_name', '.allergy_description']
         );

         bindDatatableAddRecordMethod(
            '.pet_vaccination_btn',
            petVaccinationDatatables,
            ['.vaccination_name', '.vaccination_doctor_name', '.vaccination_given_at']
         );

         bindEditMethod(
            '.pet_vaccination_list_table',
            petVaccinationDatatables,
            ['.vaccination_name', '.vaccination_doctor_name', '.vaccination_given_at']
         );

         bindDeleteMethod(
            '.pet_vaccination_list_table',
            petVaccinationDatatables,
            ['.vaccination_name', '.vaccination_doctor_name', '.vaccination_given_at']
         );

         $('#pet_type_id').val(pet.breed.pet_type_id).trigger('change');
         $('#gender').val(pet.gender).trigger('change');

         const actionBtn = `<div class='flex gap-1'>
            <button class='btn p-2 rounded-full btn-primary edit_btn'><i class='fa-solid fa-pencil'></i></button>
            <button class='btn p-2 rounded-full btn-secondary text-white delete_btn'><i class='fa-solid fa-trash'></i></button>
            </div>`;

         if (pet.pet_allergy) {
            pet.pet_allergy.forEach(function(allergy) {
               payload = [
                  allergy.name,
                  allergy.note,
                  actionBtn
               ];

               petAllergyDatatables.row.add(payload).draw();
            });
         }

         if(pet.pet_vaccination) {
            pet.pet_vaccination.forEach(function (petVac) {
               payload = [
                  petVac.vaccination.name,
                  petVac.given_by,
                  petVac.given_at,
                  actionBtn
               ];

               petVaccinationDatatables.row.add(payload).draw();
            })
         }
      });


      function bindDeleteMethod(tableSelector, datatable, inputsSelector) {
         $(tableSelector + ' tbody').on('click', '.delete_btn', function() {
            datatable.row($(this).parents('tr')).remove().draw();

            $(...inputsSelector).val('');
         });
      }

      function bindEditMethod(tableSelector, datatables, inputs) {
         $(tableSelector + ' tbody').on('click', '.edit_btn', function() {
            const row = datatables.row($(this).parents('tr'));
            const data = row.data();

            inputs.forEach(function(selector, index) {
               $(selector).val(data[index]);
            });

            $('.row_index').val(row.index());
         });
      }

      function bindDatatableAddRecordMethod(formBtnSelector, datatable, inputs) {
         $(document).on('click', formBtnSelector, function(e) {
            e.preventDefault();

            const $formElement = $(e.currentTarget).closest('form');
            const rowIndex = $formElement.find('.row_index').val();
            const payload = [];

            inputs.forEach((selector) => payload.push($formElement.find(selector).val()));

            const actionElement =
               `<div class='flex gap-1'>
               <button class='btn p-2 rounded-full btn-primary edit_btn'><i class='fa-solid fa-pencil'></i></button>
               <button class='btn p-2 rounded-full btn-secondary text-white delete_btn'><i class='fa-solid fa-trash'></i></button>
               </div>`;

            payload.push(actionElement);

            if (rowIndex) {
               datatable.row(rowIndex).data(payload);
            } else {
               datatable.row.add(payload).draw();
            }

            $(inputs.join(', ') + ' ,.row_index').val('');
         });
      }
   </script>

   {!! JsValidator::formRequest(
       'App\Http\Requests\PetOwner\StorePetRequest',
       Crypt::encrypt([
           'selector' => '.pet_basic_detail_form',
           'ignore' => '',
       ]),
   ) !!}
@endsection
