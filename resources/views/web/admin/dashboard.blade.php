@extends('web.layouts.admin')

@section('header')
    <title> Admin Dashboard </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-10 mt-10">
            <!-- Total Feedback -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback') }}</h3>
                <p class="text-3xl font-bold text-gray-800">{{$data['analytics']['total_feedback']}}</p>
            </div>

            <!-- Total Feedback Today -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_today') }}</h3>
                <p class="text-3xl font-bold text-gray-800">{{$data['analytics']['total_feedback_today']}}</p>
            </div>

            <!-- Total Admin Response -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_admin_response') }}</h3>
                <p class="text-3xl font-bold text-gray-800">{{$data['analytics']['total_admin_response_today']}}</p>
            </div>

            <!-- Total Admin Response Today -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_admin_response_today') }}</h3>
                <p class="text-3xl font-bold text-gray-800">{{$data['analytics']['total_admin_response_today']}}</p>
            </div>

            <!-- Total Feedback Completed Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_completed') }}</h3>
                <p class="text-3xl font-bold text-completed">{{$data['analytics']['total_feedback_status']['completed']}}</p>
            </div>

            <!-- Total Feedback In Progress Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_in_progress') }}</h3>
                <p class="text-3xl font-bold text-in_progress">{{$data['analytics']['total_feedback_status']['in_progress']}}</p>
            </div>

            <!-- Total Feedback Waiting Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_waiting') }}</h3>
                <p class="text-3xl font-bold text-waiting">{{$data['analytics']['total_feedback_status']['waiting']}}</p>
            </div>

            <!-- Total Feedback Waiting Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('dashboard.total_feedback_rejected') }}</h3>
                <p class="text-3xl font-bold text-rejected">{{$data['analytics']['total_feedback_status']['rejected']}}</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <canvas id="chartCategory"></canvas>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <canvas id="chartClass"></canvas>
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
                            <span class="text-sm text-gray-600">{{$feedback->category}}</span>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const analytics = @json($data['analytics']);

    function generateColors(total) {
        const colors = [];

        for (let i = 0; i < total; i++) {

            // evenly spaced hue
            const hue = (i * 45) % 360;

            // lower saturation + higher lightness
            const saturation = 80; // softer
            const lightness = 60;  // brighter / pastel

            colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
        }

        return colors;
    }

    const categoryLabels = Object.keys(analytics.total_based_on_category);
    const categoryValues = Object.values(analytics.total_based_on_category);

    new Chart(document.getElementById('chartCategory'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Feedback by Category',
                data: categoryValues,
                backgroundColor: generateColors(categoryLabels.length),
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const classLabels = analytics.total_based_on_class.map(item => item.class);
    const classValues = analytics.total_based_on_class.map(item => item.total);

    new Chart(document.getElementById('chartClass'), {
        type: 'bar',
        data: {
            labels: classLabels,
            datasets: [{
                label: 'Feedback by Class',
                data: classValues,
                backgroundColor: generateColors(classLabels.length),
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>
@endsection
