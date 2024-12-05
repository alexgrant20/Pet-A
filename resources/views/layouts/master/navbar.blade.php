<div class="navbar z-20 bg-primary px-6 absolute">
   <div class="flex-1">
      <label for="my-drawer-2" class="btn btn-primary py-3 drawer-button block xl:hidden">
         <i class="fa-regular fa-bars"></i>
      </label>
      <a href="{{ route('home') }}" class="w-28">
         <img src="{{ asset('assets/logo-square-white.png') }}" alt="logo">
      </a>
   </div>
   <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent avatar">
         <i class="fa-solid fa-bell text-xl text-base-100"></i>
         @if ($newNotificationCount > 0)
            <div class="notification-badge">
               <span
                  class="absolute top-1 left-1/2 transform -translate-x-1/3 -translate-y-1/3 w-3 h-3 bg-red-500 border-2 border-base-100 text-white text-xs font-bold rounded-full flex items-center justify-center"></span>
            </div>
         @endif
      </div>
      <ul tabindex="5"
         class="mt-3 z-[1] p-2 block shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-80 max-h-80 overflow-y-auto no-scrollbar">
         @forelse ($notifications as $notification)
            <li>
               <a href="{{ $notification->link }}">
                  <div class="items-center flex gap-2 p-2">
                     <i class="text-lg {{ $notification->icon }} text-primary"></i>
                     <span
                        class="line-clamp-2 notification @if (!$notification->is_seen) font-bold @endif">{{ $notification->title }}</span>
                  </div>
               </a>
            </li>
         @empty
            <li class="text-center justify-center text-gray-500 h-8">No Notification</li>
         @endforelse
      </ul>
   </div>
   <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent avatar">
         <div class="w-12 rounded-full tex">
            <img alt="Tailwind CSS Navbar component"
               src="{{ asset(Auth::user()->hasRole(RoleInterface::ROLE_ADMIN) ? 'assets/user.svg' : Auth::user()->profile->attachment->first()->path) }}" />
         </div>
      </div>
      <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
         @if (Auth::user()->hasRole(RoleInterface::ROLE_VETERINARIAN))
            <li>
               <a href="{{ route('admin.profile.edit', Auth::user()->profile_id) }}">Profile</a>
            </li>
         @endif
         <li><a href="{{ route('logout') }}">Logout</a></li>
      </ul>
   </div>
</div>
