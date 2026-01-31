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

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">{{__('feedback.heading')}}</h2>
                <p class="text-sm text-gray-500">{{__('feedback.sub_title')}}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">

                <!-- Head -->
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

                <!-- Body -->
                <tbody class="divide-y">

                    <!-- Row -->
                    @foreach ($data as $feedback)
                        <tr class="group hover:bg-blue-50 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{$feedback->anonymous ? __('feedback.anonymous') : $feedback->student->full_name }}</p>
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
                                    {{$feedback->category?->name}}
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
