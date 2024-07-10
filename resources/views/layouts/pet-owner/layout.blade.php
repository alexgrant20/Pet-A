<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-base-100 relative min-h-screen max-w-[100vw]">

   <div class="drawer drawer-open">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content">
         @include('layouts.pet-owner.navbar')
         <div class="pt-5 pb-20 px-6">
            @yield('content')
         </div>
      </div>
      @include('layouts.master.sidebar')
   </div>
   @include('layouts.public.footer')

   @include('layouts.master.script')
   @include('layouts.master.alert-swal')
   @include('layouts.master.toast')
   @yield('js-footer')
</body>

</html>
