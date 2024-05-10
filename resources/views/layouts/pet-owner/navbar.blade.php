<div class="navbar z-10 bg-base-100 shadow-lg rounded-3xl sticky top-0">
   <div class="navbar-start">
      <a href="{{ route('home') }}" class="w-28">
         <img src="{{ asset('assets/logo-square.png') }}" alt="logo">
      </a>
   </div>
   <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
         @foreach (@$menus as $menu)
            @if (count(@$menu['child']) > 0)
               <li>
                  <details>
                     <summary>
                        {{ @$menu['label'] }}
                     </summary>
                     <ul>
                        @foreach (@$menu['child'] as $child)
                           <li>
                              <a href="{{ route($child['route_name']) }}">{{ $child['label'] }}</a>
                           </li>
                        @endforeach
                     </ul>
                  </details>
               </li>
            @else
               <li>
                  <a href="{{ route($menu['route_name']) }}">
                     {{ @$menu['label'] }}
                  </a>
               </li>
            @endif
         @endforeach
      </ul>
   </div>

   <div class="navbar-end">
      <div class="dropdown dropdown-end">
         <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent avatar">
            <i class="fa-solid fa-bell text-xl text-amber-950"></i>
         </div>
         <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-80">
            <li>
               <a href="#">
                  <div class="flex flex-row gap-3 items-center">
                     <img alt="Tailwind CSS Navbar component" src="{{ asset('assets/blank-user-profile.png') }}"
                        class="w-12 h-12 rounded-full" />
                     <div class="flex flex-col gap-2">
                        <span class="font-semibold">Dev</span>
                        {{-- TO-DO: Kalo textnya kepanjangan perlu di truncate --}}
                        <span>Hi Bro, Capek ya? Iya :"</span>
                     </div>
                  </div>
               </a>
            </li>
         </ul>
      </div>
      <div class="dropdown dropdown-end">
         <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent avatar">
            @php
               $profilePicture = auth()->user()->profile->attachment->first();
            @endphp
            <div class="w-12 h-12 rounded-full">
               <img alt="user" src="{{ asset($profilePicture ? $profilePicture->path : 'assets/user.svg') }}" />
            </div>
         </div>
         <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
            <li>
               <a href="{{ route('pet-owner.profile.index') }}">Profile</a>
            </li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
         </ul>
      </div>

   </div>
</div>


