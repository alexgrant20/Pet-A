@extends('layouts.master.layout')

@section('title', 'Edit City')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Edit City</h1>
        {{ Breadcrumbs::render('city-edit') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.master.city.update', $city->id) }}" method="POST">
				@csrf
				@method('PUT')

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Province</span>
					</div>
					<select name="province_id" class="input input-sm input-bordered">
						<option value=""></option>
						@foreach ($provinces as $province)
							<option value="{{ $province->id }}" @selected($city->province_id == $province->id)>{{ $province->name }}</option>
						@endforeach
					</select>
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">City</span>
					</div>
					<input type="text" value="{{ $city->name }}" name="name" class="input input-sm input-bordered w-full form-control" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Latitude</span>
					</div>
					<input type="text" value="{{ $city->latitude }}" name="latitude" class="input input-sm input-bordered w-full form-control" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Longitude</span>
					</div>
					<input type="text" value="{{ $city->longitude }}" name="longitude" class="input input-sm input-bordered w-full form-control" />
				</label>


				<div class="text-right">
					<button type="submit" class="btn btn-primary btn-padding">Submit</button>
				</div>
			</form>
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateCityRequest', 'form') !!}
@endsection
