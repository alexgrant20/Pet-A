<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  @vite('resources/css/app.css')

  <script src="https://kit.fontawesome.com/1ddbafe114.js" crossorigin="anonymous"></script>

  {{-- JQUERY --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
    integrity="sha384-d3UHjPdzJkZuk5H3qKYMLRyWLAQBJbby2yr2Q58hXXtAGF8RSNO9jpLDlKKPv5v3" crossorigin="anonymous"></script>

  {{-- Datatable --}}
  <link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">

  {{-- Sweet Alert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  {{-- Loading Overlay --}}
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"
    integrity="sha384-psIDNx7Y/ho1o7wMAeoqcHKy9mBMGLJhAkHTD8sMtuhrola/NRoTQyFDKLmAN4v1" crossorigin="anonymous"></script>

  <script src="
      https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js
      "></script>
  <link href="
    https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css
    " rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">

  @yield('css-extra')
  @yield('js-header')
</head>
