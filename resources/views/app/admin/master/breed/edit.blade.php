@extends('layouts.master.layout')

@section('title', 'Add Breed')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Edit Breed</h1>
        {{ Breadcrumbs::render('breed-edit') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.master.breed.update', $breed->id) }}" method="POST">
				@csrf
				@method('PATCH')

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Breed</span>
					</div>
					<input value="{{ $breed->name }}" type="text" name="name" class="input input-bordered w-full form-validation" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Pet Type</span>
					</div>
					<select name="pet_type_id" class="input input-bordered">
						<option value=""></option>
						@foreach ($petTypes as $petType)
							<option value="{{ $petType->id }}" @selected($petType->id == $breed->pet_type_id)>{{ $petType->name }}</option>
						@endforeach
					</select>
				</label>

				<div class="text-right">
					<button type="submit" class="btn btn-primary btn-padding">Submit</button>
				</div>
			</form>
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateBreedRequest', 'form') !!}
@endsection

