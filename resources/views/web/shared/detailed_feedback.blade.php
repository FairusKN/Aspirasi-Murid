@extends('web.layouts.admin')

@section('header')
<title>Feedback #{{ $data->id }} • Admin Dashboard</title>
@endsection

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- BREADCRUMB & ACTIONS -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('pages.feedback') }}"
               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Feedback List
            </a>
            <span class="hidden sm:inline text-gray-300">|</span>
            <span class="text-sm text-gray-500">Feedback #{{ $data->id }}</span>
        </div>
        @if($data->status !== 'completed')
        <div class="flex gap-2">
            <form action="{{ route('feedbacks.create', $data->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="px-3 py-1.5 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Mark as Complete
                </button>
            </form>
        </div>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- HEADER -->
        <header class="border-b border-gray-200 bg-gray-50 px-6 py-4 sm:flex sm:items-start sm:justify-between">
            <div class="w-full sm:w-auto mb-3 sm:mb-0">
                <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 break-words">
                        {{ $data->feedback_title }}
                    </h1>
                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full whitespace-nowrap
                        {{ $data->status === 'completed'
                            ? 'bg-green-100 text-green-800'
                            : ($data->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $data->status)) }}
                    </span>
                </div>

                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-600">
                    @if($studentName = ($data->student?->full_name ?? 'Anonymous'))
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Submitted by: <strong class="text-gray-800">{{ $studentName }}</strong></span>
                    </div>
                    @endif

                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>
                            Submitted on: <time datetime="{{ $data->created_at->toIso8601String() }}">
                                {{ $data->created_at->format('F j, Y \a\t g:i A') }}
                            </time>
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- LEFT SIDE (Feedback Content) -->
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Category
                    </h2>
                    <p class="text-gray-900 font-medium">{{ ucfirst(str_replace('_', ' ', $data->category)) }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-1.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Feedback Details
                    </h2>
                    <div class="prose prose-sm max-w-none text-gray-800 mt-1">
                        <p class="whitespace-pre-line">{{ $data->details }}</p>
                    </div>
                </div>

                @if($data->image)
                <div>
                    <h2 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Attachment
                    </h2>
                    <a href="{{ $data->image }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="block group cursor-zoom-in">
                        <img
                            src="{{ $data->image }}"
                            alt="Feedback attachment: {{ $data->feedback_title }}"
                            class="rounded-lg border border-gray-200 w-full h-64 object-cover object-center transition-transform duration-300 group-hover:scale-105"
                            loading="lazy">
                        <span class="mt-2 block text-xs text-center text-blue-600 hover:text-blue-800 transition-colors">
                            View full size image
                        </span>
                    </a>
                </div>
                @endif

                @if($data->admin_response)
                <div class="pt-4 border-t border-gray-200">
                    <h2 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Admin Response
                    </h2>
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                        <p class="text-gray-800 whitespace-pre-line">{{ $data->admin_response }}</p>
                        <div class="mt-2 flex items-center text-xs text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Responded on {{ $data->updated_at?->format('F j, Y \a\t g:i A') ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT SIDE (Action Panel) -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 sticky top-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Update Feedback
                    </h2>

                    @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-700 text-sm rounded-lg border border-red-200">
                        <strong class="font-medium">Please fix the following errors:</strong>
                        <ul class="mt-1 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('feedbacks.create', $data->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select
                                id="category"
                                name="category"
                                class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @foreach(App\Enum\Category::cases() as $category)
                                        <option value="{{$category->value}}"> {{ $category }} </option>
                                    @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select
                                id="status"
                                name="status"
                                class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="waiting" {{ old('status', $data->status) === 'waiting' ? 'selected' : '' }}>Waiting</option>
                                <option value="in_progress" {{ old('status', $data->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $data->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ old('status', $data->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div>
                            <label for="admin_response" class="block text-sm font-medium text-gray-700 mb-1">
                                Admin Response
                                <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <textarea
                                id="admin_response"
                                name="admin_response"
                                rows="4"
                                class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-y"
                                placeholder="Add your response to the student here...">{{ old('admin_response', $data->admin_response) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Responses are visible to the student</p>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-3">
                            <a href="{{ route('pages.feedback') }}"
                               class="w-full sm:w-1/2 px-4 py-2.5 text-center text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors mb-2 sm:mb-0">
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="w-full sm:w-1/2 px-4 py-2.5 text-center text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-75 disabled:cursor-not-allowed"
                                {{ $errors->any() ? 'disabled' : '' }}>
                                <span wire:loading.remove>Save Changes</span>
                                <span wire:loading class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
