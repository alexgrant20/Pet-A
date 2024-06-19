@extends('layouts.master.layout')

@section('title', 'Add Breed')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Add Breed</h1>
        {{ Breadcrumbs::render('breed-create') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.master.breed.store') }}" method="POST">
				@csrf

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Breed</span>
					</div>
					<input type="text" name="name" class="input input-bordered w-full form-validation" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Pet Type</span>
					</div>
					<select name="pet_type_id" class="input input-bordered">
						<option value=""></option>
						@foreach ($petTypes as $petType)
							<option value="{{ $petType->id }}">{{ $petType->name }}</option>
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
  {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreBreedRequest', 'form') !!}
@endsection

