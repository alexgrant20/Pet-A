<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-primary relative min-h-screen max-w-[100vw] box-border flex">
   <div class="drawer drawer-open relative flex-1">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content relative flex flex-col">
         @include('layouts.pet-owner.navbar')

         <div class="w-full pb-14 flex flex-1">
            <div class="w-1/4 ms-6 hidden xl:block">
               <div class="relative mb-12">
                  <div class="flex flex-col gap-3 z-20 relative">
                     <img alt="pet image" src="{{ asset($pet?->thumbnail_image) }}" class="w-20 h-20 rounded-full bg-gray-200" />
                     <span class="text-white font-medium text-xl max-w-[85%] break-words">
                        Hello {{ $pet?->name }}
                     </span>
                     <span class="text-white text-opacity-55">
                        how can we help?
                     </span>
                  </div>
                  <div class="absolute right-0 bottom-0 z-10">
                     <img class="w-52" src="{{ asset('assets/person-bring-dog.svg') }}" alt="">
                  </div>
               </div>

               <div class="text-white text-opacity-55 pe-10">
                  <h2 class="mb-3">Pengingat</h2>

                  <div class="grid grid-rows-2 gap-3">
                     <div class="card">
                        <div class="card-body bg-white bg-opacity-85 shadow rounded-xl flex-row py-4 px-2 gap-5 items-center justify-center">
                           <div>
                              <img class="w-16 h-16 rounded-full" src="https://www.nylabone.com/-/media/project/oneweb/nylabone/images/dog101/10-intelligent-dog-breeds/golden-retriever-tongue-out.jpg" alt="">
                           </div>
                           <div class="flex flex-col gap-2">
                              <div class="text-gray-900 font-semibold">
                                 Joergen
                              </div>
                              <div class="flex items-center gap-2">
                                 <i class="fa-solid fa-calendar text-primary"></i>
                                 <span class="text-gray-900">Jan, 20, 09.00 - 10.00</span>
                              </div>
                              <div class="badge-primary badge">
                                 Vaksinasi
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-body border border-white rounded-xl py-4 px-2 gap-2 items-center justify-center">
                           <i class="fa-solid fa-plus bg-white bg-opacity-70 p-4 rounded-full text-primary"></i>
                           Add One
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="w-full xl:w-3/4 bg-base-200 mx-6 xl:ms-0 rounded-2xl overflow-x-hidden">
               @yield('content')
            </div>
         </div>
      </div>
   </div>

   <div class="flex justify-end absolute bottom-0 w-full">
      <div class="w-full lg:w-3/4 relative">
         @include('layouts.public.footer')
      </div>
   </div>

   @include('layouts.master.script')
   @include('layouts.master.alert-swal')
   @include('layouts.master.toast')
   @yield('js-footer')
</body>

</html>
