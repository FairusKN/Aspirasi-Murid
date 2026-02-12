@extends('web.layouts.admin')

@section('header')
    <title>Feedback</title>
    <script>
      tailwind.config = {
        theme: {
            extend: {
              colors: {
                'completed-text': '#2E7D32',
                'completed-bg': 'rgba(46, 125, 50, 0.15)',

                'in_progress-text': '#1B98E0',
                'in_progress-bg': 'rgba(27, 152, 224, 0.15)',

                'waiting-text': '#F9A825',
                'waiting-bg': 'rgba(249, 168, 37, 0.18)',

                'rejected-text': '#C62828',
                'rejected-bg': 'rgba(198, 40, 40, 0.15)',
              }
            }
        },
      };
    </script>
@endsection

@section('content')
<div class="p-8 mt-10">

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <div class="flex items-center justify-between px-6 py-4 border-b">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">{{__('feedback.heading')}}</h2>
                <p class="text-sm text-gray-500">{{__('feedback.sub_title')}}</p>
            </div>
        </div>

        <!-- Search dan Filter -->
        <div class="px-6 py-4 border-b bg-white">
            <form method="GET" action="{{ route('pages.feedback') }}" class="space-y-3">
                <!-- Search, Filter button -->
                <div class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="feedback_title" value="{{ request('feedback_title') }}"
                               placeholder="Cari feedback judul"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <button type="button" onclick="toggleFilter()"
                            class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Cari
                    </button>
                    <a href="{{ route('pages.feedback') }}" class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                        Reset
                    </a>
                </div>

                <div id="filterDropdown" class="hidden bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Filter Kategori -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Kategori</label>
                            <input type="text" name="category" value="{{ request('category') }}"
                                   placeholder="Filter kategori..."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>

                        <!-- Filter Lokasi -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Lokasi</label>
                            <input type="text" name="location" value="{{ request('location') }}"
                                   placeholder="Filter lokasi..."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>

                        <!-- Filter Status -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Semua Status</option>
                                <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            function toggleFilter() {
                const dropdown = document.getElementById('filterDropdown');
                dropdown.classList.toggle('hidden');
            }

            // dropdown fiilter active
            document.addEventListener('DOMContentLoaded', function() {
                const hasActiveFilters = {{ request('category') || request('location') || request('status') ? 'true' : 'false' }};
                if (hasActiveFilters) {
                    document.getElementById('filterDropdown').classList.remove('hidden');
                }
            });
        </script>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

                <thead class="sticky top-0 bg-[#006494] z-10">
                    <tr class="text-[#E8F1F2] uppercase text-xs tracking-wider">
                        <th class="px-6 py-3 text-left">{{__('feedback.student_name')}}</th>
                        <th class="px-6 py-3 text-left">{{__('feedback.title')}}</th>
                        <th class="px-6 py-3 text-center">{{__('feedback.location')}}</th>
                        <th class="px-6 py-3 text-center">{{__('feedback.date')}}</th>
                        <th class="px-6 py-3 text-center">{{__('feedback.category')}}</th>
                        <th class="px-6 py-3 text-center">{{__('feedback.status')}}</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach ($data as $feedback)
                        <tr class="group hover:bg-blue-50 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{$feedback->student->full_name }}</p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                <a href="{{ route('pages.detailed_feedback', $feedback) }}">
                                    {{Str::words($feedback->feedback_title, '50', "...")}}
                                </a>
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{$feedback->location}}
                            </td>

                            <td class="px-6 py-4 text-center text-gray-500">
                                {{$feedback->created_at->format('d F Y')}}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-600 text-xs">
                                    {{$feedback->category}}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center transition">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-{{$feedback->status}}-bg text-{{$feedback->status}}-text hover:bg-{{$feedback->status}}-bg/30 transition">
                                    {{__('feedback.' . $feedback->status)}}
                                </span>
                                </div>
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
