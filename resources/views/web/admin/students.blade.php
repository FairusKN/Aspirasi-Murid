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
                       class="text-white bg-[#247BA0] hover:bg-[#247BA0]/90 transition focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-md text-sm px-4 py-2.5 focus:outline-none"
                   >
                    {{__('student.create_student')}}
                   </button>

                   <button
                       type="button"
                       class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-md text-sm px-4 py-2.5 focus:outline-none"
                   >
                    Export
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
@endsection
