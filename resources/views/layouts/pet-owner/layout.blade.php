<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-base-100 relative min-h-screen max-w-[100vw]">
	@include('layouts.pet-owner.navbar')

  <div class="pb-32 pt-10 px-5 min-h-screen">
    @yield('content')
  </div>

  @include('layouts.public.footer')

  @include('layouts.master.script')
  @include('layouts.master.alert-swal')
  @include('layouts.master.toast')
  @yield('js-footer')
</body>

</html>
