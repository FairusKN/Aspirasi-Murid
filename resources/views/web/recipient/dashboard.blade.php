@extends('web.layouts.admin')

@section('header')
<title>Student Dashboard</title>
@endsection

@section('content')

<main class="container mx-auto px-6 py-8 space-y-10">

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

<!-- ================= RECENT FEEDBACK ================= -->
<div>

<h2 class="text-xl font-bold mb-6">Category {{$authUser->hasRecipient->category->category_name}} Feedback</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach  ( $data['feedbacks'] as $feedback)

<a href="{{route('pages.detailed_feedback', $feedback)}}">
<div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition">

<div class="flex justify-between items-start mb-3">

<h3 class="font-semibold text-gray-800">
{{$feedback->feedback_title}}
</h3>

<span class="px-2 py-1 text-xs rounded-full bg-gray-100">
{{$feedback->category->category_name}}
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
