@extends('web.layouts.admin')

@section('header')
    <title>Feedback #{{ $data->id }} • Admin Dashboard</title>
@endsection

@section('content')

<div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">

    <!-- BREADCRUMB -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">
            @if($authUser->role !== 'student')
            <a href="{{ route('pages.feedback') }}"
               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors">
                ← Back to Feedback List
            </a>


            @else
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors">
                ← Back to Dashboard
            </a>

            @endif

            <span class="hidden sm:inline text-gray-300">|</span>
            <span class="text-sm text-gray-500">Feedback #{{ $data->id }}</span>
        </div>
    </div>


    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE (CONTENT CARD) -->
        <div class="lg:col-span-2">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <!-- HEADER -->
                <header class="border-b border-gray-200 px-6 py-5">

                    <div class="flex items-start justify-between gap-4 flex-wrap">

                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                            {{ $data->feedback_title }}
                        </h1>

                        <span class="px-3 py-1 text-xs font-medium rounded-full
                            {{ $data->status === 'completed'
                                ? 'bg-green-100 text-green-800'
                                : ($data->status === 'in_progress'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($data->status === 'rejected'
                                        ? 'bg-red-100 text-red-800'
                                        : 'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucfirst(str_replace('_',' ', $data->status)) }}
                        </span>

                    </div>

                    <div class="mt-3 flex flex-wrap gap-x-4 text-sm text-gray-600">

                        <span>
                            Submitted by:
                            <strong>{{ $data->student?->full_name ?? 'Anonymous' }}</strong>
                        </span>

                        <span>
                            •
                            {{ $data->created_at->format('F j, Y \a\t g:i A') }}
                        </span>

                    </div>

                </header>


                <!-- CONTENT BODY -->
                <div class="p-6 space-y-6">

                    <!-- CATEGORY -->
                    <div class="border rounded-lg p-4">
                        <h2 class="text-sm font-medium text-gray-500 mb-1">
                            Category
                        </h2>

                        <p class="text-gray-900 font-medium">
                            {{ ucfirst(str_replace('_',' ', $data->category)) }}
                        </p>
                    </div>


                    <!-- DETAILS -->
                    <div class="border rounded-lg p-4">
                        <h2 class="text-sm font-medium text-gray-500 mb-2">
                            Feedback Details
                        </h2>

                        <p class="whitespace-pre-line text-gray-800">
                            {{ $data->details }}
                        </p>
                    </div>


                    <!-- IMAGE -->
                    @if($data->image)
                    <div class="border rounded-lg p-4">
                        <h2 class="text-sm font-medium text-gray-500 mb-2">
                            Attachment
                        </h2>

                        <a href="{{ Storage::url($data->image) }}" target="_blank">
                            <img
                                src="{{  Storage::url($data->image)}}"
                                class="rounded-lg border w-full h-64 object-cover hover:scale-[1.02] transition">
                        </a>
                    </div>
                    @endif


                    <!-- ADMIN RESPONSE -->
                    @if($data->admin_response)
                    <div class="border rounded-lg p-4 bg-blue-50 border-blue-100">
                        <h2 class="text-sm font-medium text-blue-700 mb-1">
                            Admin Response
                        </h2>

                        <p class="whitespace-pre-line text-gray-800">
                            {{ $data->admin_response }}
                        </p>

                        <p class="mt-2 text-xs text-blue-700">
                            Responded on
                            {{ $data->updated_at?->format('F j, Y \a\t g:i A') ?? 'N/A' }}
                        </p>
                    </div>
                    @endif

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE (ADMIN PANEL) -->
        @includeWhen($authUser?->role === 'admin', 'web.includes.form_feedback_response_admin')

    </div>

</div>

@endsection
