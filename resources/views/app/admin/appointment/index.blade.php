@extends('layouts.master.layout')

@section('title', 'Janji Temu')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Janji Temu</h1>
            {{-- {{ Breadcrumbs::render('city') }} --}}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <table class="table row-border w-full" id="table">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama Pemilik Hewan</th>
                  <th>Jenis Hewan Peliharaan</th>
                  <th>Tujuan</th>
                  <th>Tanggal</th>
                  <th>Sesi</th>
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
            ajax: "{{ route('admin.appointment.list') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex',
               },
               {
                  data: 'pet_owner_name',
                  name: 'pet_owner_name'
               },
               {
                  data: 'pet_type',
                  name: 'pet_type'
               },
               {
                  data: 'appointment_type',
                  name: 'appointment_type'
               },
               {
                  data: 'appointment_date',
                  name: 'appointment_date'
               },
               {
                  data: 'appointment_schedule',
                  name: 'appointment_schedule'
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
