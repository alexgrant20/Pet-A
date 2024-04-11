<div class="drawer-side">
  <div class="p-4 w-fit md:w-80 min-h-full bg-primary text-primary-content">
    <ul class="menu menu-md">
      <li>
        <a href="{{ route('admin.index') }}">
          <i class="fa fa-solid fa-home"></i>
          <span class="hidden md:block">
            Home
          </span>
        </a>
      </li>
      <li>
        <details>
          <summary>
            <i class="fa-solid fa-user"></i>
            <span class="hidden md:block">
              User Management
            </span>
          </summary>
          <ul>
            <li><a href="#">Akun</a></li>
            <li><a href="#">Role</a></li>
            <li><a href="#">Permission</a></li>
          </ul>
        </details>
      </li>
      <li>
        <details>
          <summary>
            <i class="fa-solid fa-database"></i>
            <span class="hidden md:block">
              Master Data
            </span>
          </summary>
          <ul>
            <li><a href="{{ route('admin.petType.index') }}">Pet Type</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </div>
</div>
