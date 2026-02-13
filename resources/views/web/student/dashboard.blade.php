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


<!-- Feedback Modal -->
<div id="feedbackModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">

        <!-- Close -->
        <button onclick="closeFeedbackModal()"
                class="absolute right-4 top-4 text-gray-400 hover:text-gray-700 text-xl">
            ✕
        </button>

        <h2 class="text-lg font-semibold mb-6">Create Feedback</h2>

        <form method="POST" action="{{ route('feedbacks.create')}}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input type="text" name="feedback_title" required
                       class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium mb-1">Category</label>
                <select name="category"
                        class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @foreach(App\Enum\Category::cases() as $category)
                                <option value="{{$category->value}}">
                                    {{ $category }}
                                </option>
                            @endforeach
                </select>
            </div>

            <!-- Details -->
            <div>
                <label class="block text-sm font-medium mb-1">Details</label>
                <textarea name="details" required
                          class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <input type="text" name="location" required
                       class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Anonymous -->
            <!-- <div class="flex items-center gap-2">
                <input type="checkbox" name="anonymous" value="1"
                       class="rounded border-gray-300">
                <label class="text-sm">Submit as anonymous</label>
            </div> -->

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium mb-1">Image (optional)</label>
                <input type="file" name="image"
                       class="w-full border rounded-md px-3 py-2">
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-md font-medium transition">
                Submit Feedback
            </button>

        </form>

    </div>
</div>

<button
    onclick="openFeedbackModal()"
    class="fixed bottom-6 right-6 z-40
           w-14 h-14 rounded-full
           bg-blue-600 hover:bg-blue-700
           text-white text-2xl font-bold
           shadow-lg hover:shadow-xl
           transition flex items-center justify-center"
>
    +
</button>
@endsection

@section('scripts')

<script>

function openFeedbackModal() {
    const modal = document.getElementById('feedbackModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeFeedbackModal() {
    document.getElementById('feedbackModal').classList.add('hidden');
}

// Optional: click outside to close
document.addEventListener('click', function(e){
    const modal = document.getElementById('feedbackModal');
    if(e.target === modal){
        closeFeedbackModal();
    }
});

</script>
@endsection
