@extends('layouts.master.layout')

@section('title', 'Add Service')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div class="section-left">
            <h1 class="font-bold text-2xl">Add Service</h1>
            {{ Breadcrumbs::render('service-price-create') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <form action="{{ route('admin.service-price.store') }}" method="POST">
            @csrf

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Service</span>
               </div>
               <select name="service_type_id" id="service_type_id" class="input input-bordered w-full form-validation"
                  data-placeholder="Choose Service">
                  <option value="" hidden></option>
                  @foreach ($serviceTypes as $id => $name)
                     <option value="{{ $id }}">{{ $name }}</option>
                  @endforeach
               </select>
            </label>

            <label class="form-control w-full mb-3">
               <div class="label">
                  <span class="label-text font-semibold">Harga</span>
               </div>
               <input type="text" name="price" class="input input-bordered w-full form-validation" />
            </label>

            <div class="text-right">
               <button type="submit" class="btn btn-primary btn-padding">Submit</button>
            </div>
         </form>
      </div>
   </div>
@endsection

@section('js-footer')
   {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreServicePriceRequest', 'form') !!}

   <script>
      $('#service_type_id').select2({
         minimumResultsForSearch: -1,
         placeholder: function() {
            $(this).attr('data-placeholder');
         }
      });
   </script>
@endsection
