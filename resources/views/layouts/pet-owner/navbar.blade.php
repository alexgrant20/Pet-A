<div class="navbar z-20 bg-primary rounded-3xl px-6 absolute">
   <div class="navbar-start">
      <a href="{{ route('home') }}" class="w-28 hidden xl:block">
         <img src="{{ asset('assets/logo-square-white.png') }}" alt="logo">
      </a>
      <label for="my-drawer" class="btn btn-primary drawer-button block xl:hidden">
         <i class="fa-regular fa-bars"></i>
      </label>
   </div>

   <div class="navbar-center hidden sm:flex">
      <ul class="menu menu-lg menu-horizontal px-1 text-white text-opacity-70">
         <li>
            <a class="gap-3 text-lg" href="{{ route('home') }}">
               <i class="fa fa-solid fa-home"></i>
               <span class="hidden xl:block">
                  Home
               </span>
            </a>
         </li>
         @foreach (@$menus as $menu)
            <li>
               <a class="gap-3"
                  href="{{ route($menu['route_name']) }}{{ $menu['route_name'] == 'pet-owner.appointment.index' ? "?pet_type_id={$pet?->breed?->pet_type_id}" : '' }}">
                  <i class="fa {{ @$menu['icon'] }}"></i>
                  <span class="hidden xl:block">{{ @$menu['label'] }}</span>
               </a>
            </li>
         @endforeach
      </ul>
   </div>

   <div class="navbar-end items-center gap-7">
      <div class="dropdown dropdown-end">
         <div tabindex="0" role="button" class="">
            <i class="fa-solid fa-ellipsis text-white text-opacity-50 text-[0.6rem]"></i>
         </div>
         <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
            <li>
               <a href="{{ route('pet-owner.profile.index') }}">Profile</a>
            </li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
         </ul>
      </div>

      <div class="dropdown dropdown-end">
         <div tabindex="0" role="button" class="">
            <div class="flex items-center gap-2 text-white">
               <div class="flex items-center gap-1">
                  <div
                     class="bg-white font-bold text-primary rounded-full w-5 h-5 text-[0.9rem] flex items-center justify-center bg-opacity-70">
                     {{ $pets->count() }}
                  </div>

                  @if ($pet)
                     <img alt="pet image" src="{{ asset($pet?->thumbnail_image) }}"
                        class="w-12 h-12 rounded-full bg-gray-200 hidden md:block" />
                  @else
                     <div
                        class="w-12 h-12 rounded-full bg-gray-200 hidden md:flex items-center justify-center text-black">
                        <i class="fa-thin fa-paw-simple fa-2x"></i>
                     </div>
                  @endif
               </div>
               <span class="tracking-wider">Profile</span>
               <i class="fa-solid fa-chevron-down"></i>
            </div>
         </div>
         <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-md dropdown-content bg-base-100 rounded-box w-52">
            @foreach ($pets as $pet)
               <li>
                  <a class="block" href="{{ route('pet-owner.pet.switch-pet-profile', $pet->id) }}">
                     <div class="flex gap-3 items-center w-full">
                        <div class="w-12">
                           <img alt="pet image" src="{{ asset($pet->thumbnail_image) }}"
                              class="w-12 h-12 rounded-full border border-gray-200" />
                        </div>
                        <div class="font-semibold max-w-32">{{ $pet->name }}</div>
                     </div>
                  </a>
               </li>
            @endforeach
            <li>
               <a class="flex items-center justify-center gap-2 hover:bg-transparent w-full"
                  href="{{ route('pet-owner.pet.create') }}">
                  <i class="fa-solid fa-plus p-2 bg-primary rounded-full text-white"></i>
                  <span class="font-semibold max-w-32">Add More Pet</span>
               </a>
            </li>
         </ul>
      </div>
   </div>
</div>
