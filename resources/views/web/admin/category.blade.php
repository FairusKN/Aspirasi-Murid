@extends('web.layouts.admin')

@section('header')
    <title>Category</title>
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
                    <h2 class="text-lg font-semibold text-gray-800">Category</h2>
                    <p class="text-sm text-gray-500">Manage recipients</p>
                </div>
                <div class="align-right pt-5">
                    <button
                        type="button"
                        onclick="openCategoryModal()"
                        class="text-white bg-[#247BA0] hover:bg-[#247BA0]/90 transition focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-md text-sm px-4 py-2.5 focus:outline-none"
                    >
                        Create Category
                    </button>
                </div>
            </div>

        <!-- Search dan Filter -->
        <div class="px-6 py-4 border-b bg-white">
            <form method="GET" action="{{ route('categories.index') }}" class="space-y-3">
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
                    <a href="{{ route('categories.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
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

                        <th class="px-3 py-3 text-left w-1/3">
                            Name
                        </th>

                        <th class="px-4 py-3 text-left w-1/6">
                            Recipients Count
                        </th>

                        <th class="px-6 py-3 text-center w-1/6">
                            Action
                        </th>

                    </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">

                        @foreach ($data as $category)
                            <tr class="group hover:bg-blue-50 transition">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $category->category_name }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700 text-left">
                                    {{ $category->recipients_count }}
                                </td>

                                <td class="px-6 py-4 text-center space-x-2">

                                    <!-- Edit -->
                                    <button
                                        onclick="openEditModal('{{ $category->id }}', '{{ $category->category_name }}')"
                                        class="px-3 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-md"
                                    >
                                        Edit
                                    </button>

                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this category?')"
                                            class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-md"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    <div>
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Overlay -->
    <div id="editModal"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">

            <button onclick="closeEditModal()"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-4">Edit Category</h2>

            <form method="POST" id="editForm" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Category Name
                    </label>
                    <input
                        type="text"
                        name="category_name"
                        id="editCategoryName"
                        required
                        class="w-full border border-gray-300 rounded-md px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-md"
                >
                    Update
                </button>
            </form>

        </div>
    </div>

    <div id="recipientModal"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

        <!-- Modal Box -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 relative">

            <!-- Close Button -->
            <button onclick="closeCategoryModal()"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-4">Create Category</h2>

            <!-- Manual Form -->
            <div id="manualForm">

                <form method="POST" action="{{ route('categories.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Category Name
                        </label>
                        <input
                            type="text"
                            name="category_name"
                            placeholder="Enter category name"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 transition text-white
                                   font-medium py-2.5 rounded-md"
                        >
                            Create Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function openCategoryModal() {
            document.getElementById('recipientModal').classList.remove('hidden');
            document.getElementById('recipientModal').classList.add('flex');
        }

        function closeCategoryModal() {
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

        function openEditModal(id, name) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const input = document.getElementById('editCategoryName');

            form.action = `/categories/${id}`;
            input.value = name;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endsection
