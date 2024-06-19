@extends('layouts.master.layout')

@section('title', 'User Management')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Kelola Pengguna</h1>
            {{ Breadcrumbs::render('user-management') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <div role="tablist" class="tabs tabs-lifted tabs-md">
            <input type="radio" name="tab" id="pet_owner_tab" role="tab" class="tab" aria-label="Pemilik Hewan"
               checked />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
               @include('app.admin.user-management.components.tab.__pet-owner')
            </div>

            <input type="radio" name="tab" id="veterinarian_tab" role="tab" class="tab"
               aria-label="Dokter Hewan" />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
               @include('app.admin.user-management.components.tab.__veterinarian')
            </div>

            <input type="radio" name="tab" id="admin_tab" role="tab" class="tab" aria-label="Admin" />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
               @include('app.admin.user-management.components.tab.__admin')
            </div>
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      const ROLE_PET_OWNER = "{{ RoleInterface::ROLE_PET_OWNER }}";
      const ROLE_VETERINARIAN = "{{ RoleInterface::ROLE_VETERINARIAN }}";
      const ROLE_ADMIN = "{{ RoleInterface::ROLE_ADMIN }}";
      $(document).ready(function() {
         initDataTable(ROLE_PET_OWNER, '#datatable_pet_owner');
         $('#veterinarian_tab').on('click', function() {
            initDataTable(ROLE_VETERINARIAN, '#datatable_veterinarian');
         });
         $('#admin_tab').on('click', function() {
            initDataTable(ROLE_ADMIN, '#datatable_admin');
         });

         $('#pet_owner_tab').on('click', function() {
            initDataTable(ROLE_PET_OWNER, '#datatable_pet_owner');
         })
      });

      $(document).on('click', '#btn_delete_user', function(e) {
         e.preventDefault();
         const id = $(this).attr('data-id');
         const nama = $(this).attr('data-title');

         swal({
            title: "Apakah Anda Yakin?",
            text: `Anda akan menghapus pengguna ${nama}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
         }).then((reason) => {
            $(`#delete_form_${id}`).submit();
            $.LoadingOverlay("show");
         });
      });

      function initDataTable(role, selectorTable) {
         let url = "{{ route('admin.user-management.list', ['roleId' => '::roleId::']) }}";
         url = url.replace('::roleId::', role);

         let payloadColumn = [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex',
            },
            {
               data: 'name',
               name: 'name'
            },
            {
               data: 'email',
               name: 'email'
            },
            {
               data: 'action',
               name: 'action',
               orderable: false
            }
         ];

         if (role == ROLE_VETERINARIAN) {
            payloadColumn.splice(3, 0, {
               data: 'clinic_name',
               name: 'clinic_name'
            });
         }

         $(selectorTable).DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            destroy: true,
            ajax: url,
            columns: payloadColumn,
         });
      }
   </script>
@endsection
