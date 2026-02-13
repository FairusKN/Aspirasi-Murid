@extends('web.layouts.admin')

@section('header')
<title>Student Dashboard</title>
@endsection

@section('content')

<main class="container mx-auto px-6 py-8 space-y-10">
<!-- ================= RECENT FEEDBACK ================= -->
<div>

<h2 class="text-xl font-bold mb-6">Recent Feedback</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach  ( $data->hasFeedback as $feedback)

<a href="{{route('pages.detailed_feedback', $feedback)}}">
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
