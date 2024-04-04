<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <i class="fa-solid fa-house"></i>
          <span class="ms-3">Home</span>
        </a>
      </li>
      <li>
        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <i class="fa-solid fa-user"></i>
          <span class="ms-3">User Management</span>
        </a>
      </li>
      <li>
        <button type="button"
          class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
          aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
          <i class="fa-solid fa-database"></i>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Master</span>
          <i class="fa-solid fa-chevron-down"></i>
        </button>
        <ul id="dropdown-example" class="hidden py-2 space-y-2">
          <li>
            <a href="#"
              class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Pet Categories</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</aside>
