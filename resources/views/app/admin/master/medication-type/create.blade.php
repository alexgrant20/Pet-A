@extends('layouts.master.layout')

@section('title', 'Add Medication Type')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div class="section-left">
        <h1 class="font-bold text-2xl">Add Medication Type</h1>
        {{ Breadcrumbs::render('medication-type-create') }}
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
			<form action="{{ route('admin.master.medication-type.store') }}" method="POST">
				@csrf

				<label class="form-control w-full mb-3">
					<div class="label">
						<span class="label-text font-semibold">Medication Type</span>
					</div>
					<input type="text" name="name" class="input input-sm input-bordered w-full form-control" />
				</label>

				<div class="text-right">
					<button type="submit" class="btn btn-primary btn-padding">Submit</button>
				</div>
			</form>
    </div>
  </div>
@endsection

@section('js-footer')
  {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreMedicationTypeRequest', 'form') !!}
@endsection

