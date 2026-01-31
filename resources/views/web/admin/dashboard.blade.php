@extends('web.layouts.admin')

@section('header')
 <title> Admin Dashboard </title>
    <script>
      tailwind.config = {
        theme: {
            extend: {
              colors: {
                completed   : '#2E7D32',
                in_progress : '#1B98E0',
                waiting     : '#F9A825',
                rejected    : '#C62828'
              }
            }
        },
      };
    </script>
@endsection

@section('content')
  <main class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20 mt-10">
            <!-- Total Feedback Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback') }}</h3>
                <p class="text-3xl font-bold text-gray-800">{{$data['total_feedback']}}</p>
            </div>

            <!-- Total Feedback Completed Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_completed') }}</h3>
                <p class="text-3xl font-bold text-green-600">{{$data['total_feedback_completed']}}</p>
            </div>

            <!-- Total Feedback In Progress Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_in_progress') }}</h3>
                <p class="text-3xl font-bold text-yellow-600">{{$data['total_feedback_in_progress']}}</p>
            </div>

            <!-- Total Feedback Waiting Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_waiting') }}</h3>
                <p class="text-3xl font-bold text-red-600">{{$data['total_feedback_waiting']}}</p>
            </div>
        </div>

        <!-- Recent Feedbacks Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">{{__('dashboard.recent_feedbacks')}}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($data['recent_feedback'] as $feedback)
                <!-- Feedback Card 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $feedback->feedback_title}} test</h3>
                    <p class="text-sl text-gray-900 mb-6">{{Str::words($feedback->details, 20, '...')}}</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">{{$feedback->category->name}}</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-{{$feedback->status}} rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">{{$feedback->status}}</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">{{__('dashboard.created_at')}}: {{$feedback->created_at->format('d F Y')}}</p>
                </div>
            @endforeach

            </div>
        </div>
    </main>
@endsection
