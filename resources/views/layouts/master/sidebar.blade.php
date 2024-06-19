<div class="drawer-side">
  <div class="p-4 w-fit md:w-80 min-h-full bg-primary text-primary-content">
    <ul class="menu menu-md">
      <li>
        <a href="{{ route('home') }}">
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
              <summary>
                <i class="fa {{ @$menu['icon'] }}"></i>
                <span class="hidden md:block">
                  {{ @$menu['label'] }}
                </span>
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
            <a class="nav-link" href="{{ route($menu['route_name']) }}">
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
