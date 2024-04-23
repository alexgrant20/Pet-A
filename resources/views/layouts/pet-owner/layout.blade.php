<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-base-100 relative" style="max-width: 100vw; min-height: 100vh;">
	@include('layouts.master.navbar')

  <div class="pb-32 pt-10 px-5 ">
    @yield('content')

  </div>
  @include('layouts.public.footer')

  @include('layouts.master.script')
  @include('layouts.master.alert-swal')
  @include('layouts.master.toast')
  @yield('js-footer')
</body>

</html>
