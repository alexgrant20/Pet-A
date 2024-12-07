@extends('layouts.master.layout')

@section('title', 'User Support')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body">
         <div>
            <h1 class="font-bold text-2xl">User support</h1>
            {{ Breadcrumbs::render('user-support') }}
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

         const petAllergyDatatables = new DataTable('#table', {
            bLengthChange: false,
            autoWidth: false,
            order: [],
            columns: [{
                  data: 'user.name',
                  name: 'name'
               },
               {
                  data: 'is_read',
                  name: '',
                  render: function(data, col, row) {
                     return data ? '' : '<span class="badge badge-primary text-white">New Message</span>';
                  },
                  orderable: false
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  render: function(data, col, row) {
                     const url = "{{ route('admin.chat.show', ':id') }}".replace(':id', row.user.id);

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
