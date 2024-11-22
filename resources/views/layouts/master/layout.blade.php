<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-primary min-h-screen max-w-[100vw]">
  <div class="drawer xl:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    @include('layouts.master.navbar')
    <div class="drawer-content flex flex-col flex-1 relative">
      <div class="w-full pb-14 flex flex-1 mt-20">
         <div class="w-full bg-base-200 mx-6 xl:ms-0 rounded-2xl overflow-x-hidden p-5">
            @yield('content')
         </div>
      </div>
      <div class="flex justify-end absolute bottom-0 w-full">
         @include('layouts.master.footer')
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
