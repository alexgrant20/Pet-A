@extends('layouts.master.layout')

@section('title', 'Clinic')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Clinic</h1>
            {{ Breadcrumbs::render('clinic') }}
         </div>
         <div>
            <a href="{{ route('admin.clinic.create') }}" class="btn btn-primary btn-padding">Add Clinic<i
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
                  <th class="w-1/12">Clinic Image</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>City</th>
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

      $(document).on('click', '#btn_delete_clinic', function(e) {
         e.preventDefault();
         const id = $(this).attr('data-id');
         const nama = $(this).attr('data-title');

         swal({
            title: "Are You Sure?",
            text: `You will delete clinic ${nama}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
         }).then((ok) => {
            if (ok) {
               $(`#delete_form_${id}`).submit();
               $.LoadingOverlay("show");
            }
         });
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
