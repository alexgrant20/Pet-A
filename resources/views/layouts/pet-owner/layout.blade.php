<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

@include('layouts.master.header')

<body class="bg-primary relative min-h-screen max-w-[100vw] box-border flex">
   <div class="drawer xl:drawer-open">
      <input id="my-drawer" type="checkbox" class="drawer-toggle" />
      @include('layouts.pet-owner.navbar')
      <div class="drawer-content flex flex-col flex-1 relative">
         <div class="w-full pb-14 flex flex-1 mt-20">
            <div class="w-full bg-base-200 mx-1 sm:mx-6 xl:ms-0 rounded-2xl overflow-x-hidden">
               @yield('content')
            </div>
         </div>
         <div class="flex justify-end absolute bottom-0 w-full">
            @include('layouts.public.footer')
         </div>
      </div>
      <div class="drawer-side w-full z-20 mt-20 pb-24">
         <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay xl:hidden"></label>
         <div class="min-h-full ps-6 bg-primary xl:w-128">
            <div class="relative mb-12">
               <div class="flex flex-col gap-3 z-20">
                  @if ($pet)
                     <img alt="pet image" src="{{ asset($pet?->thumbnail_image) }}"
                        class="w-20 h-20 rounded-full bg-gray-200 hidden sm:block" />
                  @else
                     <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="fa-thin fa-paw-simple fa-2x"></i>
                     </div>
                  @endif
                  <span class="text-white font-medium text-xl max-w-[85%] break-words">
                     Hello {{ $pet?->name }}
                  </span>
                  <span class="text-white text-opacity-55">
                     how can we help?
                  </span>
               </div>
               <div class="absolute right-0 top-1">
                  <img class="w-52 hidden sm:block" src="{{ asset('assets/person-bring-dog.svg') }}" alt="">
               </div>
            </div>

            <div class="text-white/90 pe-5 mb-5 block sm:hidden">
               <h2 class="mb-3 text-xl">Menu</h2>
               <div class="navbar-center flex">
                  <ul class="menu menu-lg menu-vertical px-1 text-white text-opacity-70">
                     <li>
                        <a class="gap-3 text-lg" href="{{ route('home') }}">
                           <i class="fa fa-solid fa-home"></i>
                           <span>
                              Home
                           </span>
                        </a>
                     </li>
                     @foreach (@$menus as $menu)
                        <li>
                           <a class="gap-3" href="{{ route($menu['route_name']) }}">
                              <i class="fa {{ @$menu['icon'] }}"></i>
                              <span>{{ @$menu['label'] }}</span>
                           </a>
                        </li>
                     @endforeach
                  </ul>
               </div>
            </div>

            @php
               $notifications = auth()->user()->notification->where('date_start', '>=', now()->format('Y-m-d'));
            @endphp
            <div class="text-white/90 pe-5 mb-5">
               <h2 class="mb-3 text-xl">Reminder</h2>
               <div
                  class="grid grid-flow-row gap-y-2 {{ $notifications->count() == 1 ? 'grid-rows-2' : '' }} overflow-y-auto h-64 no-scrollbar">
                  @forelse ($notifications ?? [] as $notif)
                     <div class="card">
                        <div
                           class="card-body bg-white bg-opacity-85 shadow rounded-xl flex-row py-4 px-2 gap-2 items-center">
                           <div class="w-20">
                              <img class="w-16 h-16 rounded-full hidden sm:block"
                                 src="{{ asset($notif->pet->attachment->first()->path) }}" alt="">
                           </div>
                           <div class="flex flex-col gap-2 w-full">
                              <div class="text-gray-900 font-semibold">
                                 {{ $notif->pet->name }}
                              </div>
                              <div class="flex items-center gap-2">
                                 <i class="fa-solid fa-calendar text-primary"></i>
                                 <span class="text-gray-900">
                                    {{ $notif->date_start->format('M,d H:i') }}
                                 </span>
                              </div>
                              <div class="text-black">
                                 {{ $notif->title }}
                              </div>

                              @if ($notif->link)
                                 <a href="{{ $notif->link }}" class="btn btn-accent text-white w-fit p-2">
                                    Check Appointment
                                 </a>
                              @endif
                           </div>
                        </div>
                     </div>
                  @empty
                     <div class="card">
                        <div
                           class="card-body border border-white rounded-xl py-4 px-2 gap-2 items-center justify-center">
                           <i class="fa-solid fa-bells fa-2x bg-white bg-opacity-70 p-4 rounded-full text-primary"></i>
                           Your pet deserves your full attention—no notifications, just love!
                        </div>
                     </div>
                  @endforelse
               </div>
            </div>
            <a class="card pe-5 absolute bottom-0" href="{{ route('pet-owner.chat', auth()->user()->id) }}">
               <div
                  class="card-body bg-white/70 shadow rounded-full flex-row py-4 px-2 gap-5 items-center justify-center">
                  <i class="fa-duotone fa-solid fa-messages-question text-primary text-xl"></i>
                  <span class="text-gray-700">Chat Our Admin</span>
               </div>
            </a>
         </div>

      </div>
   </div>

   @include('layouts.master.script')
   @include('layouts.master.alert-swal')
   @include('layouts.master.toast')
   @yield('js-footer')
</body>

</html>
