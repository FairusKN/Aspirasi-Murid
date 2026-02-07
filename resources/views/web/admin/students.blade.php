@extends('web.layouts.admin')

@section('header')
    <title>Student</title>
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
                    <h2 class="text-lg font-semibold text-gray-800">{{__('student.title')}}</h2>
                    <p class="text-sm text-gray-500">{{__('student.sub_title')}}</p>
                </div>
                <div class="align-right pt-5">
                    <button
                        type="button"
                        onclick="openStudentModal()"
                        class="text-white bg-[#247BA0] hover:bg-[#247BA0]/90 transition focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-md text-sm px-4 py-2.5 focus:outline-none"
                    >
                        {{__('student.create_student')}}
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm table-fixed">

                    <!-- Head -->
                    <thead class="sticky top-0 bg-[#006494] z-10">
                    <tr class="text-[#E8F1F2] uppercase text-xs tracking-wider">

                        <th class="px-6 py-3 text-left w-1/3">
                            {{__('feedback.student_name')}}
                        </th>

                        <th class="px-6 py-3 text-left w-1/3">
                            Email
                        </th>

                        <th class="px-6 py-3 text-center w-1/6">
                            NIS
                        </th>

                        <th class="px-6 py-3 text-center w-1/6">
                            Status
                        </th>

                    </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">

                        <!-- Row -->
                        @foreach ($data as $student)
                            <tr class="group hover:bg-blue-50 transition">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div>
                                        <p class="font-medium text-gray-800">{{$student->full_name }}</p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                   {{$student->email}}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{$student->nis}}
                                </td>

                                <td class="px-6 py-4 text-center text-gray-500">
                                    <form method="POST" action="{{ route('users.toggle_activate', $student)}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <button type="submit" class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{$statusClasses[$student->is_active ? 'is_active' : 'not_active']}}">
                                            {{$student->is_active ? "Aktif" : "Tidak AKtif"}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4 ">
                    <div >
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Overlay -->
    <div id="studentModal"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

        <!-- Modal Box -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6 relative">

            <!-- Close Button -->
            <button onclick="closeStudentModal()"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-4">Create Student</h2>

            <!-- Tabs -->
            <div class="flex gap-3 mb-6">
                <button onclick="showTab('manual')" id="tabManual"
                    class="px-4 py-2 rounded-md bg-blue-600 text-white text-sm">
                    Manual Input
                </button>

                <button onclick="showTab('upload')" id="tabUpload"
                    class="px-4 py-2 rounded-md bg-gray-200 text-sm">
                    Upload File
                </button>
            </div>

            <!-- Manual Form -->
            <div id="manualForm">

                <form method="POST" action="{{ route('users.create') }}" class="space-y-5">
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
                            placeholder="student@email.com"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- NIS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            NIS
                        </label>
                        <input
                            type="text"
                            name="nis"
                            placeholder="Student ID"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- Class -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Class
                        </label>
                        <select
                            name="class"
                            class="w-full border border-gray-300 rounded-md px-3 py-2
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            @foreach(App\Enum\UserClass::cases() as $class)
                                <option value="{{$class->value}}">
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password (Optional)
                        </label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Leave empty for default password"
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
                            Create Student
                        </button>
                    </div>

                </form>

            </div>

            <!-- Upload Form -->
            <div id="uploadForm" class="hidden">

                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="file"
                           class="border rounded-md px-3 py-2 w-full">

                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md">
                        Upload
                    </button>
                </form>

                <!-- Example Table -->
                <div class="mt-6">

                    <p class="text-sm font-medium mb-2">Example File Format:</p>

                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2">email</th>
                                <th class="px-3 py-2">full_name</th>
                                <th class="px-3 py-2">nis</th>
                                <th class="px-3 py-2">class</th>
                                <th class="px-3 py-2">password</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-3 py-2">teststudentabc@gmail.com</td>
                                <td class="px-3 py-2">John Doe</td>
                                <td class="px-3 py-2">XII – RPL 2</td>
                                <td class="px-3 py-2">23874623</td>
                                <td class="px-3 py-2">password (opsional)</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function openStudentModal() {
            document.getElementById('studentModal').classList.remove('hidden');
            document.getElementById('studentModal').classList.add('flex');
        }

        function closeStudentModal() {
            document.getElementById('studentModal').classList.add('hidden');
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
