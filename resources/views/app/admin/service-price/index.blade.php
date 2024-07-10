@extends('layouts.master.layout')

@section('title', 'Service')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Service</h1>
            {{ Breadcrumbs::render('service-price') }}
         </div>
         <div>
            <a href="{{ route('admin.service-price.create') }}" class="btn btn-primary btn-padding">Add Service<i
                  class="fa fa-solid fa-plus"></i></a>
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <table class="table row-border w-full" id="table">
            <thead>
               <tr>
                  <th class="w-1/12">No</th>
                  <th>Service</th>
                  <th>Harga</th>
                  <th class="w-2/12"></th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      $(document).ready(function() {
         initDataTable();
      });

      function initDataTable() {
         $('#table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ route('admin.service-price.list') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex',
               },
               {
                  data: 'service_name',
                  name: 'service_name'
               },
               {
                  data: 'price',
                  name: 'price'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
               }
            ]
         });
      }
   </script>
@endsection
