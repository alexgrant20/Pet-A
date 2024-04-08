@extends('layouts.master.layout')

@section('title', 'Pet Types')

@section('css-extra')
  <style>

  </style>
@endsection

@section('content')
  <div class="card bg-base-200 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Add Pet Types</h1>
        {{ Breadcrumbs::render('pet-type-edit') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-200 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.petType.update', $petType->id) }}" method="POST">
				@csrf
				@method('PUT')

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Pet Types</span>
					</div>
					<input type="text" value="{{ $petType->name }}" name="name" class="input input-sm input-bordered w-full form-control" />
				</label>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePetTypeRequest', 'form') !!}
@endsection

