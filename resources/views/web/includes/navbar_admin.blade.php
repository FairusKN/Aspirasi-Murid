<nav class="bg-[#1a2b45] text-white px-6 py-3 flex items-center justify-between border-b border-blue-300">
    <!-- Logo Section -->
    <div class="flex items-center ml-3 p-2">
        <img src="https://placehold.co/40x40/FFD700/000000?text=Logo" alt="Logo" class="h-10 w-10 rounded-full">
        <span class="font-semibold text-lg ml-3">school name</span>
    </div>

    <!-- Navigation Links - Centered -->
    <div class="absolute left-1/2 transform -translate-x-1/2">
        <div class="flex space-x-8">
          <a
            href="{{ route('pages.dashboard') }}"
            class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
          >
            Dashboard
            <span
              class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
            ></span>
          </a>

          <a
            href="{{ route('pages.feedback')}}"
            class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
          >
            Feedback
            <span
              class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
            ></span>
          </a>

          <a
            href="#"
            class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
          >
            Student
            <span
              class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
            ></span>
          </a>

          <a
            href="#"
            class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
          >
            Log
            <span
              class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
            ></span>
          </a>
        </div>
    </div>

    <!-- User Profile Dropdown -->
    <div class="relative flex items-center mr-3">
        <button
            type="button"
            class="flex text-sm rounded-full focus:ring-4 focus:ring-blue-300"
            id="user-menu-button"
            aria-expanded="false"
            data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom-end"
        >
            <span class="sr-only">Open user menu</span>
            <img
                class="w-9 h-9 rounded-full"
                src="https://placehold.co/40x40/FFD700/000000?text={{$authUser->full_name[0]}}"
                alt="user photo"
            >
        </button>

        <!-- Dropdown -->
        <div
            class="z-50 hidden absolute right-0 mt-2 w-44 bg-white text-gray-700 rounded-lg shadow-lg border border-gray-200"
            id="user-dropdown"
        >
            <div class="px-4 py-3 text-sm border-b">
                <span class="block font-semibold text-gray-900">{{$authUser->full_name}}</span>
                <span class="block truncate text-gray-500">{{$authUser->email}}</span>
                <span class="block truncate text-gray-500">{{$authUser->nis}}</span>
            </div>
            <ul class="py-2 text-sm">
                <li>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        >
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
