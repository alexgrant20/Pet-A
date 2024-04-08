<div class="navbar z-10 bg-base-200 shadow-2xl sticky top-0">
  <div class="flex-1">
    <a class="btn btn-ghost hover:bg-transparent text-xl">Pet-a</a>
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
  <div class="flex-none">
  </div>
</div>
