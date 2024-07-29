<div class="navbar fixed top-0 z-10 bg-base-200/5 backdrop-blur-sm" id="navbar">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="#home">Home</a></li>
        <li><a href="#digitilize-data">PawRecord</a></li>
        <li><a href="#notification">Pawvication</a></li>
      </ul>
    </div>
    <a href="{{ route('welcome') }}" class="px-3">
      <img class="w-28" src="{{ asset('assets/logo-square.png') }}" alt="logo">
    </a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1 text-gray-900 font-semibold">
      <li><a href="#home">Home</a></li>
      <li><a href="#digitilize-data">PawRecord</a></li>
      <li><a href="#notification">Pawvication</a></li>
    </ul>
  </div>
  <div class="navbar-end">
    <a href="{{ route('login') }}" class="btn btn-primary text-base-100 rounded-full btn-padding">Login</a>
  </div>
</div>
</div>
