<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#E8F1F2]">
    <header>
        <nav class="bg-[#1a2b45] text-white px-6 py-3 flex items-center justify-between border-b border-blue-300">
            <!-- Logo Section -->
            <div class="flex items-center ml-3 p-2">
                <img src="https://placehold.co/40x40/FFD700/000000?text=Logo" alt="Logo" class="h-10 w-10 rounded-full">
                <span class="font-semibold text-lg ml-3">SMK Merdeka Bandung</span>
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
                    href="#"
                    class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
                  >
                    Feedbacks
                    <span
                      class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
                    ></span>
                  </a>

                  <a
                    href="#"
                    class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
                  >
                    Students
                    <span
                      class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
                    ></span>
                  </a>

                  <a
                    href="#"
                    class="group relative inline-block hover:text-[#1B98E0] transition-colors duration-200"
                  >
                    Logs
                    <span
                      class="absolute left-0 -bottom-1 h-0.5 w-0 bg-[#1B98E0] transition-all duration-300 group-hover:w-full"
                    ></span>
                  </a>
                </div>
            </div>

            <!-- User Icon -->
            <div class="flex items-center mr-3 p-2">
                <i class="fas fa-user text-xl hover:text-yellow-300 cursor-pointer transition-colors duration-200"></i>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>

