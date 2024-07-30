@extends('layouts.master.layout')

@section('title', 'Tempat Praktik')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Tempat Praktik</h1>
            {{ Breadcrumbs::render('clinic') }}
         </div>
         <div>
            <a href="{{ route('admin.clinic.create') }}" class="btn btn-primary btn-padding">Tambah Tempat Praktik<i
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
                  <th class="w-1/12">Gambar Tempat Praktik</th>
                  <th>Nama</th>
                  <th>Nomor Telepon</th>
                  <th>Kota</th>
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
            ajax: "{{ route('admin.clinic.list') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex',
               },
               {
                  data: 'image',
                  name: 'image'
               },
               {
                  data: 'name',
                  name: 'name'
               },
               {
                  data: 'phone_number',
                  name: 'phone_number'
               },
               {
                  data: 'city',
                  name: 'city'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
               },
            ],
            order:[3, 'asc']
         });
      }
   </script>
@endsection
