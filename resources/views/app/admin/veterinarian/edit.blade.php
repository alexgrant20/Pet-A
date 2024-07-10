@extends('layouts.master.layout')

@section('title', 'Veterinarian')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Edit Veterinarian</h1>
        {{-- {{ Breadcrumbs::render('appointment-type-create') }} --}}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
      <form action="{{ route('admin.veterinarian.update', $veterinarian->id) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="flex flex-col xl:flex-row gap-5 mb-5">
          <div class="flex flex-col gap-5 items-center justify-center mb-3 flex-grow">
            <div class="relative">
              <label for="profile_image" class="link">
                <div
                  class="absolute w-12 h-12 flex items-center justify-center bg-black bg-opacity-60 transition-colors text-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hover:bg-opacity-65">
                  <i class="fa-regular fa-images"></i>
                </div>
              </label>
              <img id="profile_image_preview" class="w-36 h-36 rounded-md unselectable"
                src="{{ asset($veterinarian->attachment->first()?->path) }}" alt="profile image">
            </div>
            <input name="profile_image" id="profile_image" type="file" class="hidden" accept=".png, .jpg, .jpeg" />
          </div>

          <div class="flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <label class="form-control w-full mb-3">
                <div class="label">
                  <span class="label-text font-semibold">Name</span>
                </div>
                <input type="text" name="name" value="{{ $veterinarian->user->name }}"
                  class="input input-bordered w-full form-validation" />
              </label>

              <label class="form-control w-full mb-3">
                <div class="label">
                  <span class="label-text font-semibold">Phone Number</span>
                </div>
                <input type="number" name="phone_number" value="{{ $veterinarian->user->phone_number }}"
                  class="input input-bordered w-full form-validation" />
              </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
              <label class="form-control w-full mb-3">
                <div class="label">
                  <span class="label-text font-semibold">Birth Date</span>
                </div>
                <input type="date" name="birth_date" value="{{ $veterinarian->user->birth_date }}"
                  class="input input-bordered w-full form-validation" />
              </label>

              <label class="form-control w-full mb-3">
                <div class="label">
                  <span class="label-text font-semibold">Gender</span>
                </div>
                <select name="gender" class="select select-bordered w-full form-validation">
                  <option value="" hidden></option>
                  <option value="m">Male</option>
                  <option value="f">Female</option>
                </select>
              </label>

              <label class="form-control w-full mb-3">
                <div class="label">
                  <span class="label-text font-semibold">Length Of Service</span>
                </div>
                <input type="number" name="length_of_service" value="{{ $veterinarian->length_of_service }}"
                  class="input input-bordered w-full form-validation" />
              </label>
            </div>

            <label class="form-control w-full mb-3">
              <div class="label">
                <span class="label-text font-semibold">Address</span>
              </div>
              <input type="text" name="address" value="{{ $veterinarian->user->address }}"
                class="input input-bordered w-full form-validation" />
            </label>

            <label class="form-control w-full mb-3">
              <div class="label">
                <span class="label-text font-semibold">Doctor Speciality</span>
              </div>
              <select name="doctor_pet_type[]" class="select-2 select select-bordered w-full form-validation" multiple>
                <option value="" hidden></option>
                @foreach ($petTypes as $petType)
                  <option value="{{ $petType->id }}">{{ $petType->name }}</option>
                @endforeach
              </select>
            </label>
          </div>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary btn-padding">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js-footer')
  <script>
    $('#profile_image').change(function() {
      previewImageWithSelector(
        this,
        '#profile_image_preview',
        "{{ asset('assets/default-pet.jpg') }}")
    });

    $(document).ready(function() {
      const prevDoctorPetTypeId = {{ $veterinarian->petType->pluck('id') }}.map(String);

      $('[name="gender"]').val("{{ $veterinarian->user->gender }}");
      $('[name="doctor_pet_type[]"]').val(prevDoctorPetTypeId).trigger('change');

    });
  </script>

  {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateVeterinarianRequest', 'form') !!}
@endsection
