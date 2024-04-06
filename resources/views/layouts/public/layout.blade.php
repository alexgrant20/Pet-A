<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>@yield('title')</title>
   @vite('resources/css/app.css')

   <script src="https://kit.fontawesome.com/1ddbafe114.js" crossorigin="anonymous"></script>

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

   {{-- Data Table --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"
      integrity="sha384-V05SibXwq2x9UKqEnsL0EnGlGPdbHwwdJdMjmp/lw3ruUri9L34ioOghMTZ8IHiI" crossorigin="anonymous">
   <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/css/dataTables.checkboxes.min.css"
      integrity="sha384-F3idKa7NpGXP7ZhGiJdIBDFtO9iKxJZejC1BtZ8Y15B6e7L4BrOV1/QjyivMFUy6" crossorigin="anonymous">

   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
</head>

<body class="relative" style="max-width: 100vw; min-height: 100vh;">
   @include('layouts.public.navbar')

   @yield('content')

   @include('layouts.components.alert-swal')
</body>

</html>
