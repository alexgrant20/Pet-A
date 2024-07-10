<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-base-300 min-h-screen max-w-[100vw]">
  <div class="drawer drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      @include('layouts.master.navbar')
      <div class="py-5 px-6">
        @yield('content')
      </div>
    </div>
    @include('layouts.master.sidebar')
  </div>

  @include('layouts.master.script')
  @include('layouts.master.alert-swal')
  @include('layouts.master.toast')
  @yield('js-footer')
</body>

</html>
