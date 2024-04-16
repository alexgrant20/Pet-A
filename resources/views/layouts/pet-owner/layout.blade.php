<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-base-100" style="max-width: 100vw; min-height: 100vh;">
	@include('layouts.master.navbar')
	@yield('content')

  @include('layouts.master.script')
  @include('layouts.master.alert-swal')
  @include('layouts.master.toast')
  @yield('js-footer')
</body>

</html>
