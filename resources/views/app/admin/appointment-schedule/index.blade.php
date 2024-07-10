@extends('layouts.master.layout')

@section('title', 'Jadwal Praktik')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Jadwal Dokter Hewan</h1>
            {{ Breadcrumbs::render('appointment-schedule') }}
         </div>
         <div>
            <a href="{{ route('admin.appointment-schedule.create') }}" class="btn btn-primary btn-padding">
               Tambah Jadwal
               <i class="fa fa-solid fa-plus"></i>
            </a>
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <table class="table row-border w-full" id="table">
            <thead>
               <tr>
                  <th class="w-1/12">No</th>
                  <th>Hari</th>
                  <th>Jadwal</th>
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
            ajax: "{{ route('admin.appointment-schedule.list') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex',
               },
               {
                  data: 'day',
                  name: 'day'
               },
               {
                  data: 'start_time',
                  name: 'start_time'
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
