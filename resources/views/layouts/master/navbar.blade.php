<div class="navbar z-10 bg-base-100 shadow-lg rounded-3xl sticky top-0">
  <div class="flex-1">
    <a href="{{ route('home') }}" class="w-28">
      <img src="{{ asset('assets/logo-square.png') }}" alt="logo">
    </a>
  </div>
  <div class="dropdown dropdown-end">
    <div tabindex="0" role="button" class="btn btn-ghost hover:bg-transparent avatar">
      <i class="fa-solid fa-bell text-xl text-amber-950"></i>
    </div>
    <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-80">
      <li>
        <a href="#">
          <div class="flex flex-row gap-3 items-center">
            <img alt="Tailwind CSS Navbar component"
              src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
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
      <div class="w-12 rounded-full">
        <img alt="Tailwind CSS Navbar component"
          src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
      </div>
    </div>
    <ul tabindex="5" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
      <li>
        <a href="#">Profile</a>
      </li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>
</div>
