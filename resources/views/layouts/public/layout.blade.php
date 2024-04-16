<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="relative overflow-x-hidden" style="max-width: 100vw; min-height: 100vh;">
   @yield('content')

   @include('layouts.master.script')
   @include('layouts.master.alert-swal')
   @include('layouts.master.toast')
   @yield('js-footer')
</body>

</html>
