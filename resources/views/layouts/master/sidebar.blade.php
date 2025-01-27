<div class="drawer-side w-full z-20 mt-20 pb-24">
   <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay xl:hidden"></label>
   <div class="min-h-full ps-6 bg-primary w-72 flex-column">
      <ul class="menu w-full menu-md gap-3">
         <li>
            <a class="text-[1.1rem] gap-4 text-white" href="{{ route('home') }}">
               <i class="fa fa-solid fa-home"></i>
               <span class="xl:block">
                  Home
               </span>
            </a>
         </li>

         @foreach (@$menus as $menu)
            @if (count(@$menu['child']) > 0)
               <li>
                  <details>
                     <summary class="text-[1.1rem] gap-3 text-white">
                        <i class="fa {{ @$menu['icon'] }} "></i>
                        <span class="xl:block">
                           {{ @$menu['label'] }}
                        </span>
                     </summary>
                     <ul>
                        @foreach (@$menu['child'] as $child)
                           <li class="text-[1.1rem] text-white">
                              <a href="{{ route($child['route_name']) }}">{{ $child['label'] }}</a>
                           </li>
                        @endforeach
                     </ul>
                  </details>
               </li>
            @else
               <li>
                  <a class="nav-link text-[1.1rem] gap-4 text-white" href="{{ route($menu['route_name']) }}">
                     <i class="fa {{ @$menu['icon'] }}"></i>
                     <span class="xl:block">
                        {{ @$menu['label'] }}
                        @if (@$menu['label'] == 'User Support' && $newMessageCount > 0)
                           <div class="badge badge-secondary">{{ $newMessageCount }}</div>
                        @endif
                     </span>
                  </a>
               </li>
            @endif
         @endforeach
      </ul>
   </div>
</div>
