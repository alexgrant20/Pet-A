@extends('layouts.master.layout')

@section('title', 'Appointment Type')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <div>
            <h1 class="font-bold text-2xl">User support</h1>
            {{ Breadcrumbs::render('appointment-type') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <table class="table row-border w-full" id="table">
            <thead>
               <tr>
                  <th>Name</th>
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
         const user = @json($user);

         console.log(user);

         const petAllergyDatatables = new DataTable('#table', {
            bLengthChange: false,
            autoWidth: false,
            columns: [{
                  data: 'name',
                  name: 'name'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function(data, col, row) {
                     const url = "{{ route('admin.chat.show', ':id') }}".replace(':id', row.id);

                     return `
                     <div class='flex gap-1'>
                        <a href='${url}' class='btn p-2 rounded-full btn-secondary text-white'><i class='fa-solid fa-eye'></i></a>
                     </div>
                     `
                  }
               }
            ],
            data: user,
         });
      });
   </script>
@endsection
