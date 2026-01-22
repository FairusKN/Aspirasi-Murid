<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Feedback Dashboard - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#E8F1F2]">

    <!-- Top Bar -->
    <header class="bg-[#13293D] text-white px-8 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Feedback Admin</h1>
        <span class="text-sm font-medium">
            {{ auth()->user()->name ?? 'Admin' }}
        </span>
    </header>

    <!-- Main Content -->
    <main class="p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-semibold text-gray-800">Feedback Overview</h2>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button
                    type="submit"
                    class="bg-[#1B98E0] text-white px-4 py-2 rounded-md hover:bg-[#1686C9]"
                >
                    Logout
                </button>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border border-[#247BA0]/20">
                <h3 class="text-gray-500 text-sm">Total Feedback</h3>
                <p class="text-3xl font-bold mt-2">0</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border border-[#247BA0]/20">
                <h3 class="text-gray-500 text-sm">Pending Review</h3>
                <p class="text-3xl font-bold mt-2">0</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border border-[#247BA0]/20">
                <h3 class="text-gray-500 text-sm">Resolved</h3>
                <p class="text-3xl font-bold mt-2">0</p>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-[#247BA0]/20">
            <div class="px-6 py-4 border-b">
                <h3 class="font-medium text-lg">Recent Feedback</h3>
            </div>
            <div class="p-6 text-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-12 w-12 mx-auto text-gray-400"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-4">No feedback received yet.</p>
                <p class="text-sm mt-1">Feedback will appear here once submitted.</p>
            </div>
        </div>
    </main>

</body>
</html>
