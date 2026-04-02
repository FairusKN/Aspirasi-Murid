@extends('web.layouts.admin')

@section('header')
    <title>Recipient</title>
    <script>
      tailwind.config = {
        theme: {
            extend: {
              colors: {
                'is_active-text': '#2E7D32',
                'is_active-bg': 'rgba(46, 125, 50, 0.15)',

                'not_active-text': '#C62828',
                'not_active-bg': 'rgba(198, 40, 40, 0.15)',
              }
            }
        },
      };
    </script>
@endsection

@php
   $statusClasses = [
       'is_active' => 'bg-is_active-bg text-is_active-text hover:bg-is_active-bg/30 transition',
       'not_active' => 'bg-not_active-bg text-not_active-text hover:bg-not_active-bg/30 transition',
   ];
@endphp

@section('content')
    <div class="p-8 mt-10">

        <!-- Error Message -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-6">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-6">
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">

            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Recipient</h2>
                    <p class="text-sm text-gray-500">Manage recipients</p>
                </div>
                <div class="align-right pt-5">
                    <button
                        type="button"
                        onclick="openRecipientModal()"
                        class="text-white bg-[#247BA0] hover:bg-[#247BA0]/90 transition focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-md text-sm px-4 py-2.5 focus:outline-none"
                    >
                        Create Recipient
                    </button>
                </div>
            </div>

        <!-- Search dan Filter -->
        <div class="px-6 py-4 border-b bg-white">
            <form method="GET" action="{{ route('pages.recipients') }}" class="space-y-3">
                <!-- Search, Filter button -->
                <div class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search recipient... (Name, Email)"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Search
                    </button>
                    <a href="{{ route('pages.recipients') }}" class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <script>
        </script>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm table-fixed">

                    <!-- Head -->
                    <thead class="sticky top-0 bg-[#006494] z-10">
                    <tr class="text-[#E8F1F2] uppercase text-xs tracking-wider">

                        <th class="px-6 py-3 text-left w-1/3">
                            Full Name
                        </th>

                        <th class="px-6 py-3 text-left w-1/3">
                            Email
                        </th>

                        <th class="px-6 py-3 text-center w-1/6">
                            Category
                        </th>

                        <th class="px-6 py-3 text-center w-1/6">
                            Status
                        </th>

                    </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">

                        @foreach ($data['recipients'] as $recipient)
                            <tr class="group hover:bg-blue-50 transition">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $recipient->full_name }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $recipient->email }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $recipient->hasRecipient?->category?->category_name  ?? 'No Category'}}
                                </td>

                                <td class="px-6 py-4 text-center text-gray-500">
                                    <form method="POST" action="{{ route('users.toggle_activate', $recipient) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <button type="submit" class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$recipient->is_active ? 'is_active' : 'not_active'] }}">
                                            {{ $recipient->is_active ? "Active" : "Inactive" }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    <div>
                        {{ $data['recipients']->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Overlay -->
    <div id="recipientModal"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

        <!-- Modal Box -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 relative">

            <!-- Close Button -->
            <button onclick="closeRecipientModal()"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-4">Create Recipient</h2>

            <!-- Tabs -->
            <div class="flex gap-3 mb-6">
                <button onclick="showTab('manual')" id="tabManual"
                    class="px-4 py-2 rounded-md bg-blue-600 text-white text-sm">
                    Manual Input
                </button>

                <button onclick="showTab('upload')" id="tabUpload"
                    disabled
                    class="px-4 py-2 rounded-md bg-gray-400 text-sm">
                    Upload File
                </button>
            </div>

            <!-- Manual Form -->
            <div id="manualForm">

                <form method="POST" action="{{ route('recipients.create') }}" class="space-y-5">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Full Name
                        </label>
                        <input
                            type="text"
                            name="full_name"
                            placeholder="Enter full name"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            placeholder="recipient@email.com"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Category
                        </label>
                        <select
                            name="category_id"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            @foreach($data['categories'] as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="*********"
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 transition text-white
                                   font-medium py-2.5 rounded-md"
                        >
                            Create Recipient
                        </button>
                    </div>

                </form>

            </div>

            <!-- Upload Form (disabled placeholder) -->
            <div id="uploadForm" class="hidden">
                <p class="text-sm text-gray-500">Upload feature coming soon.</p>
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function openRecipientModal() {
            document.getElementById('recipientModal').classList.remove('hidden');
            document.getElementById('recipientModal').classList.add('flex');
        }

        function closeRecipientModal() {
            document.getElementById('recipientModal').classList.add('hidden');
        }

        function showTab(type) {

            const manual = document.getElementById('manualForm');
            const upload = document.getElementById('uploadForm');

            const tabManual = document.getElementById('tabManual');
            const tabUpload = document.getElementById('tabUpload');

            if(type === 'manual') {
                manual.classList.remove('hidden');
                upload.classList.add('hidden');

                tabManual.classList.add('bg-blue-600','text-white');
                tabUpload.classList.remove('bg-blue-600','text-white');
                tabUpload.classList.add('bg-gray-200');
            } else {
                upload.classList.remove('hidden');
                manual.classList.add('hidden');

                tabUpload.classList.add('bg-blue-600','text-white');
                tabManual.classList.remove('bg-blue-600','text-white');
                tabManual.classList.add('bg-gray-200');
            }

        }
    </script>
@endsection
