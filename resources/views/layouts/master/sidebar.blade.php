<div class="drawer-side">
  <div class="p-4 w-fit md:w-80 min-h-full bg-white bg-red text-neutral-400">
    <ul class="menu menu-md gap-3">
      <li>
        <a class="text-[1.1rem] gap-4" href="{{ route('home') }}">
          <i class="fa fa-solid fa-home"></i>
          <span class="hidden md:block">
            Home
          </span>
        </a>
      </li>

      @foreach (@$menus as $menu)
        @if (count(@$menu['child']) > 0)
          <li>
            <details>
              <summary class="text-[1.1rem] gap-3">
                <i class="fa {{ @$menu['icon'] }}"></i>
                <span class="hidden md:block text-3xl">
                  {{ @$menu['label'] }}
                </span>
              </summary>
              <ul>
                @foreach (@$menu['child'] as $child)
                  <li class="text-[1.1rem]">
                    <a href="{{ route($child['route_name']) }}">{{ $child['label'] }}</a>
                  </li>
                @endforeach
              </ul>
            </details>
          </li>
        @else
          <li>
            <a class="nav-link text-[1.1rem] gap-4" href="{{ route($menu['route_name']) }}">
              <i class="fa {{ @$menu['icon'] }}"></i>
              <span class="hidden md:block">
                {{ @$menu['label'] }}
              </span>
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</div>
