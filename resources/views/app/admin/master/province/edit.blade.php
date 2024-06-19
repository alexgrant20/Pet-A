@extends('layouts.master.layout')

@section('title', 'Edit Province')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Edit Province</h1>
        {{ Breadcrumbs::render('province-edit') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.master.province.update', $province->id) }}" method="POST">
				@csrf
				@method('PUT')

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Province</span>
					</div>
					<input type="text" value="{{ $province->name }}" name="name" class="input input-bordered w-full form-validation" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Latitude</span>
					</div>
					<input type="text" value="{{ $province->latitude }}" name="latitude" class="input input-bordered w-full form-validation" />
				</label>

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Longitude</span>
					</div>
					<input type="text" value="{{ $province->longitude }}" name="longitude" class="input input-bordered w-full form-validation" />
				</label>

				<div class="text-right">
					<button type="submit" class="btn btn-primary btn-padding">Submit</button>
				</div>
			</form>
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateProvinceRequest', 'form') !!}
@endsection

