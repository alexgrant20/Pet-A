@extends('layouts.master.layout')

@section('title', 'Veterinarian')

@section('content')
  <div class="card bg-base-100 shadow-xl w-full mb-5">
    <div class="card-body flex-row items-center justify-between">
      <div>
        <h1 class="font-bold text-2xl">Veterinarian</h1>
        {{-- {{ Breadcrumbs::render('appointment-type') }} --}}
      </div>
      <div>
        <a href="{{ route('admin.veterinarian.create') }}" class="btn btn-primary btn-padding">Add Veterinarian <i
            class="fa fa-solid fa-plus"></i></a>
      </div>
    </div>
  </div>

  <div class="card bg-base-100 shadow-xl w-full">
    <div class="card-body">
      <table class="table row-border cell-border w-full" id="table">
        <thead>
          <tr>
            <th class="w-1/12">Picture</th>
            <th>Name</th>
            <th class="w-3/12">Doctor Speciality</th>
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
        ajax: "{{ route('admin.veterinarian.list') }}",
        columns: [{
            data: 'photo',
            name: 'photo'
          },
          {
            data: 'user.name',
            name: 'user.name'
          },
          {
            data: 'doctor_speciality',
            name: 'doctor_speciality'
          },
          {
            data: 'action',
            name: 'action'
          }
        ]
      });
    }
  </script>

@endsection
