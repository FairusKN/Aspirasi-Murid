@extends('web.layouts.admin')

@section('header')
<title>Admin Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                completed:'#22c55e',
                in_progress:'#3b82f6',
                waiting:'#f59e0b',
                rejected:'#ef4444'
            }
        }
    }
}
</script>
@endsection

@section('content')

<main class="container mx-auto px-6 py-8 space-y-10">

<!-- ================= HEADER ================= -->
<div>
    <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
    <p class="text-gray-500 mt-1">Quick insight into feedback activity.</p>
</div>


<!-- ================= KPI ROW ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- TOTAL -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-gray-500 text-sm">Total Feedback</p>
        <h2 class="text-4xl font-bold mt-2">{{$data['analytics']['total_feedback'] ?? 0}}</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-gray-500 text-sm">Today</p>
        <h2 class="text-4xl font-bold mt-2">{{$data['analytics']['total_feedback_today'] ?? 0}}</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-gray-500 text-sm">Admin Responses</p>
        <h2 class="text-4xl font-bold mt-2">{{$data['analytics']['total_admin_response'] ?? 0}}</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-gray-500 text-sm">Responses Today</p>
        <h2 class="text-4xl font-bold mt-2">{{$data['analytics']['total_admin_response_today'] ?? 0}}</h2>
    </div>

</div>


<!-- ================= STATUS SUMMARY ================= -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">

    <div class="bg-completed/10 text-completed rounded-xl p-4">
        <p class="text-sm">Completed</p>
        <p class="text-2xl font-bold">{{$data['analytics']['total_feedback_status']['completed'] ?? 0}}</p>
    </div>

    <div class="bg-in_progress/10 text-in_progress rounded-xl p-4">
        <p class="text-sm">In Progress</p>
        <p class="text-2xl font-bold">{{$data['analytics']['total_feedback_status']['in_progress'] ?? 0}}</p>
    </div>

    <div class="bg-waiting/10 text-waiting rounded-xl p-4">
        <p class="text-sm">Waiting</p>
        <p class="text-2xl font-bold">{{$data['analytics']['total_feedback_status']['waiting'] ?? 0}}</p>
    </div>

    <div class="bg-rejected/10 text-rejected rounded-xl p-4">
        <p class="text-sm">Rejected</p>
        <p class="text-2xl font-bold">{{$data['analytics']['total_feedback_status']['rejected'] ?? 0}}</p>
    </div>

</div>


<!-- ================= CHARTS ================= -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- CATEGORY PIE -->
    <div class="bg-white rounded-xl shadow-sm border p-6 h-[320px]">

        <h3 class="font-semibold mb-4">Feedback by Category</h3>

        <div class="h-[240px]">
            <canvas id="chartCategory"></canvas>
        </div>

    </div>

    <!-- CLASS BAR -->
    <div class="bg-white rounded-xl shadow-sm border p-6 h-[320px]">

        <h3 class="font-semibold mb-4">Feedback by Class</h3>

        <!-- Scroll viewport -->
        <div class="h-[240px] overflow-y-auto">

            <div id="chartClassWrapper">
                <canvas id="chartClass"></canvas>
            </div>

        </div>

    </div>

</div>


<!-- ================= RECENT FEEDBACK ================= -->
<div>

<h2 class="text-xl font-bold mb-6">Recent Feedback</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach ($data['recent_feedback'] as $feedback)

<a href="{{ route('pages.detailed_feedback', $feedback) }}">
<div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition">

<div class="flex justify-between items-start mb-3">

<h3 class="font-semibold text-gray-800">
{{$feedback->feedback_title}}
</h3>

<span class="px-2 py-1 text-xs rounded-full bg-gray-100">
{{$feedback->category}}
</span>

</div>

<p class="text-gray-600 text-sm mb-5">
{{Str::words($feedback->details,20,'...')}}
</p>

<div class="flex justify-between items-center">

<span class="text-xs text-gray-400">
{{$feedback->created_at->format('d M Y')}}
</span>

<span class="text-xs font-medium text-{{$feedback->status}}">
{{$feedback->status}}
</span>

</div>

</div>
</a>

@endforeach

</div>

</div>

</main>

@endsection


@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

const analytics = @json($data['analytics']);

function generateColors(total){
    const colors=[];
    for(let i=0;i<total;i++){
        colors.push(`hsl(${(i*45)%360},70%,60%)`);
    }
    return colors;
}

/* ================= CATEGORY PIE ================= */

const categoryLabels = Object.keys(analytics.total_based_on_category ?? {});
const categoryValues = Object.values(analytics.total_based_on_category ?? {});

new Chart(document.getElementById('chartCategory'),{
    type:'pie',
    data:{
        labels:categoryLabels,
        datasets:[{
            data:categoryValues,
            backgroundColor:generateColors(categoryLabels.length)
        }]
    },
    options:{
        responsive:true,
        maintainAspectRatio:false,
        layout:{
            padding:10
        },
        plugins:{
            legend:{position:'left'}
        }
    }
});


/* ================= CLASS BAR ================= */

const classLabels = (analytics.total_based_on_class ?? []).map(i=>i.class);
const classValues = (analytics.total_based_on_class ?? []).map(i=>i.total);

const canvas = document.getElementById('chartClass');
const wrapper = document.getElementById('chartClassWrapper');

const BAR_HEIGHT = 32;
const EXTRA_PADDING = 40;

wrapper.style.height = (classLabels.length * BAR_HEIGHT + EXTRA_PADDING) + 'px';

new Chart(canvas,{
    type:'bar',
    data:{
        labels:classLabels,
        datasets:[{
            data:classValues,
            backgroundColor:generateColors(classLabels.length),
            borderRadius:6,
            barThickness:18
        }]
    },
    options:{
        indexAxis:'y',
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{display:false}
        },
        scales:{
            x:{ beginAtZero:true },
            y:{ ticks:{ autoSkip:false } }
        }
    }
});

}); // ⭐ THIS WAS MISSING

</script>

@endsection
