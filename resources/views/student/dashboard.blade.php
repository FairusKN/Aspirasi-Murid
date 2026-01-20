<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Submit Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">We Value Your Feedback</h1>
            <p class="text-gray-600 mt-2">Help us improve by sharing your experience</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf

            <div class="space-y-6">
                <!-- Feedback Title -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="feeedback_title">
                        Feedback Title *
                    </label>
                    <input
                        type="text"
                        id="feeedback_title"
                        name="feeedback_title"
                        value="{{ old('feeedback_title') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="e.g. Slow response time"
                        required
                    />
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="category_id">
                        Category *
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required
                    >
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Details -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="details">
                        Details *
                        <span class="text-gray-500 text-sm">(Max 255 characters)</span>
                    </label>
                    <textarea
                        id="details"
                        name="details"
                        rows="4"
                        maxlength="255"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Describe your feedback in detail..."
                        required
                    >{{ old('details') }}</textarea>
                    <div class="text-right text-xs text-gray-500 mt-1">
                        <span id="charCount">255</span> characters remaining
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="location">
                        Location *
                    </label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="e.g. Jakarta, Indonesia"
                        required
                    />
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        Submit Feedback
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center text-gray-500 text-sm mt-8">
            <p>All fields marked with * are required.</p>
        </div>

        <!-- Logout Form -->
        <div class="text-center mt-6">
            <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                @csrf
                <button
                    type="submit"
                    class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm"
                >
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Optional: Character counter for details -->
    <script>
        document.getElementById('details').addEventListener('input', function () {
            const maxLength = 255;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            document.getElementById('charCount').textContent = remaining;
        });
    </script>
</body>
</html>
